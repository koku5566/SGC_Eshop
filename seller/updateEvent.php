<?php
    require __DIR__ . '/header.php'
?>

<?php
	// if($_SESSION['login'] == false)
	// {
	// 	echo "<script>alert('Login to Continue');
	// 		window.location.href='login.php';</script>";
    // }
?>

<?php
    $_SESSION['eventUpdate'] = $_GET['eventUpdate'];
    $updateEventID = $_SESSION['eventUpdate'];
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST["eRegister"])){
        $decs = "";
        $tnc = "";
        $pic = "";
        $eID = mysqli_real_escape_string($conn, SanitizeString($_POST["hiddenID"]));
        echo 'hello';
        $sqlget = "SELECT * FROM `event` WHERE `event`.`event_id` = $eID";
        $resultget = mysqli_query($conn, $sqlget);
            if (mysqli_num_rows($resultget) > 0) {
                while($row1 = mysqli_fetch_assoc($resultget)) {
                $picLocation = "/img/event/".$row1["cover_image"];
                $decs = html_entity_decode($row1['description']);
                $tnc = html_entity_decode($row1['event_tnc']);
                $pic = $row1["cover_image"];
                
            

                $coverIMG = array_filter($_FILES['coverImage']['name']);
                $targetDir = dirname(__DIR__, 1)."/img/event/"; 
                $allowTypes = array('jpg','png','jpeg'); 
                $categoryPic = "";
                //echo $_SESSION['eventUpdate'],$picLocation, $decs, $tnc, $coverIMG;
                //$imageProperties = getimageSize($_FILES['coverImage']['tmp_name']);
                $coverImgContent = addslashes(file_get_contents($_FILES['coverImage']['name']));

                if(!empty($coverIMG)){ 
                    foreach($_FILES['coverImage']['name'] as $key=>$val){ 
                        // File upload path 
                        echo(var_dump($_FILES['coverImage']));
                        $fileName = basename($_FILES['coverImage']['name'][$key]); 
                        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                        $fileName = round(microtime(true) * 1000).".".$ext;
                        $targetFilePath = $targetDir.$fileName; 
                        echo($targetFilePath);
                        // Check whether file type is valid 
                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                        if(in_array($fileType, $allowTypes)){ 
                            if(move_uploaded_file($_FILES["coverImage"]["tmp_name"][$key], $targetFilePath)){ 
                                $categoryPic = "$fileName";
                            }
                        }
                    } 
                }

                $eTitle = mysqli_real_escape_string($conn, SanitizeString($_POST["eventTitle"]));
                $eDateFrom = mysqli_real_escape_string($conn, SanitizeString($_POST["eDate_From"]));
                $eDateTo = mysqli_real_escape_string($conn, SanitizeString($_POST["eDate_To"]));
                $eTimeFrom = mysqli_real_escape_string($conn, SanitizeString($_POST["eTime_From"]));
                $eTimeTo = mysqli_real_escape_string($conn, SanitizeString($_POST["eTime_To"]));
                $eDes = htmlentities($_POST["eDesc"]); //decode using stripslashes
                $eCat = mysqli_real_escape_string($conn, SanitizeString($_POST["eCategory"]));
                $eLoc = mysqli_real_escape_string($conn, SanitizeString($_POST["eLocation"]));
                
                $eTnc = htmlentities($_POST["eTnC"]);//decode using html_entity_decode()
                //echo $eTitle, $eDateFrom, $eDateTo,  $eTimeFrom ,  $eTimeTo,$eDes, $eCat , $eLoc, $eTnc ;
                //check for changes
                if(empty($eDes))
                {
                    $eDes = $decs;
                }
                if(empty($eTnc))
                {
                    $eTnc = $tnc;
                }
                if(empty($coverIMG))
                {
                    $categoryPic = $pic;
                }

                if($eTitle == $row1['event_name'] && $eDateFrom == $row1['event_date'] && $eDateTo == $row1['eventEnd_date'] && $eTimeFrom == $row1['event_time'] && $eTimeTo == $row1['eventEnd_time'] && $eDes == $row1['description'] && $eCat == $row1['category'] && $eLoc == $row1['location'] && $eTnc == $row1['event_tnc']){
                    echo "<script>alert('Nothing Changed');window.location.href='./eventSellerDashboard.php';</script>";
                }
                else
                {
                    $sql = "UPDATE `event` SET `cover_image`=?,`event_name`=?,`event_date`=?,`eventEnd_date`=?,`event_time`=?,`eventEnd_time`=?,`description`=?,`category`=?,`location`=?,`event_tnc`=? WHERE `event_id` = ?";
                    if ($stmt = mysqli_prepare($conn,$sql)){
                        if(false===$stmt){
                            die('Error with prepare: ') . htmlspecialchars($mysqli->error);
                            echo '1';
                        }
                        $bp = mysqli_stmt_bind_param($stmt,"ssssssssssi",$categoryPic, $eTitle,$eDateFrom,$eDateTo,$eTimeFrom,$eTimeTo,$eDes,$eCat,$eLoc,$eTnc,$eID);
                        if(false===$bp){
                            die('Error with bind_param: ') . htmlspecialchars($stmt->error);
                            echo '2';
                        }
                        $bp = mysqli_stmt_execute($stmt);
                        if ( false===$bp ) {
                            die('Error with execute: ') . htmlspecialchars($stmt->error);
                            echo '3';
                        }
                            if(mysqli_stmt_affected_rows($stmt) == 1){
                                echo "<script>alert('Update Event Successful');window.location.href='./eventSellerDashboard.php';</script>";
                            }
                            else{
                                $error = mysqli_stmt_error($stmt);
                                echo "<script>alert($error + 'sss');</script>";
                            }		
                            mysqli_stmt_close($stmt);
                    }
                        echo '0';
                }
            }
        }
            

            
        }
?>

<title>Update Event</title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="../css/event.css">


    <!-- Begin Page Content -->
    <div class="container-fluid" style="width:80%">
    <!-- Above template -->

    <h1 style="margin-top: 50px;">Update Event</h1>
    <div class="d-lg-block d-xl-block d-xxl-block" style="margin-top: 30px;">
        
        <!-- Form for create new event -->
        <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" enctype="multipart/form-data">
            <?php
                $sql = "SELECT * FROM `event` WHERE `event`.`event_id` = ".$_SESSION['eventUpdate']."";
                $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                        $picLocation = "/img/event/".$row["cover_image"];
                        $decs = html_entity_decode($row['description']);
                        $tnc = html_entity_decode($row['event_tnc']);
                        $eventName = $row['event_name'];
                        
                        echo("
                        <section style=\"padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;\">
                        <h2>Update Cover Image (Maximum 1 picture Allowed) (size: 1920x1080)</h2>
                            <img src=\"$picLocation\" style=\"width:100%;\" />
                            <input class=\"form-control\" type=\"file\" id=\"coverImg\" style=\"margin-top: 10px;\" name=\"coverImage[]\" accept=\".png,.jpeg,.jpg\">
                    </section>
                    
                    <section style=\"padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;\">
                        <h2>Event Details</h2>
                        <h3 style=\"margin-top: 30px;\">Event Title<input class=\"form-control\" type=\"text\" required placeholder=\"Event Title\" style=\"margin-top: 10px;\" name=\"eventTitle\" value=\"$eventName\"></h3>
                        <div>
                            <div class=\"row\">
                                <div class=\"col-sm-2\">
                                    <h3 style=\"margin-top: 30px;width: 100%;\">Event Date</h3>
                                </div>
                                <div class=\"col-sm-2\">
                                    <div class=\"form-check\" style=\"width: 100%;margin-top: 44px;\"><input class=\"form-check-input\" type=\"checkbox\" id=\"oneDayEvent_check\"><label class=\"form-check-label\" for=\"formCheck-1\"><strong>One-Day Event</strong></label></div>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"col-sm-5\"><input class=\"form-control\" type=\"date\" name=\"eDate_From\" id=\"eStartDate\" value=".$row['event_date']." required></div>
                                <div class=\"col-sm-2\">
                                    <h5 style=\"text-align: center;margin-top: 6px;\">To</h5>
                                </div>
                                <div class=\"col-sm-5\"><input class=\"form-control\" type=\"date\" name=\"eDate_To\" id=\"eEndDate\" value=".$row['eventEnd_date']." required></div>
                            </div>
                        </div>
                        <div>
                            <h3 style=\"margin-top: 30px;width: 100%;\">Event Time</h3>
                            <div class=\"row\">
                                <div class=\"col-sm-5\"><input class=\"form-control\" type=\"time\" name=\"eTime_From\" value=".$row['event_time']." required></div>
                                <div class=\"col-sm-2\">
                                    <h5 style=\"text-align: center;margin-top: 6px;\">To</h5>
                                </div>
                                <div class=\"col-sm-5\"><input class=\"form-control\" type=\"time\" name=\"eTime_To\" value=".$row['eventEnd_time']." required></div>
                            </div>
                        </div>
                        <div style=\"margin-top: 30px;\">
                            <h2>Previous Event Description</h2>
                            <div>
                                $decs
                            </div>
                            <h3>Description</h3>
                            <textarea class=\"form-control\" id=\"eDesceditor\" placeholder=\"Edit your description here...\" name=\"eDesc\"></textarea>
                        </div>
                        <div style=\"margin-top: 30px;\">
                            <h3>Category</h3><input class=\"form-control\" type=\"text\" name=\"eCategory\" value=".$row['category'].">
                        </div>
                        <div>
                            <div class=\"row\">
                                <div class=\"col-sm-2\">
                                    <h3 style=\"margin-top: 30px;width: 100%;\">Location</h3>
                                </div>
                                <div class=\"col-sm-2\">
                                    <div class=\"form-check\" style=\"width: 100%;margin-top: 44px;\"><input class=\"form-check-input\" type=\"checkbox\" id=\"onlineCheck\"><label class=\"form-check-label\" for=\"oneDayEvent_check-1\"><strong>Online Event</strong></label></div>
                                </div>
                            </div><select class=\"form-select\" name=\"eLocation\" id=\"optionLocation\"value=".$row['location'].">
                                <optgroup label=\"Northern Region\">
                                    <option value=\"Perlis\">Perlis</option>
                                    <option value=\"Kedah\">Kedah</option>
                                    <option value=\"Pulau Pinang\">Pulau Pinang</option>
                                    <option value=\"Perak\">Perak</option>
                                </optgroup>
                                <optgroup label=\"Central Region\">
                                    <option value=\"Selangor\">Selangor</option>
                                    <option value=\"Kuala Lumpur\">Kuala Lumpur</option>
                                    <option value=\"Putrajaya\">Putrajaya</option>
                                </optgroup>
                                <optgroup label=\"East Coast Region\">
                                    <option value=\"Kelantan\">Kelantan</option>
                                    <option value=\"Terengganu\">Terengganu</option>
                                    <option value=\"Pahang\">Pahang</option>
                                </optgroup>
                                <optgroup label=\"Southern Region\">
                                    <option value=\"Negeri Sembilan\">Negeri Sembilan</option>
                                    <option value=\"Melaka\">Melaka</option>
                                    <option value=\"Johor\" selected=\"\">Johor</option>
                                </optgroup>
                                <optgroup label=\"East Malaysia\">
                                    <option value=\"Sabah\">Sabah</option>
                                    <option value=\"Sarawak\">Sarawak</option>
                                    <option value=\"Labuan\">Labuan</option>
                                </optgroup>
                                <optgroup label=\"Virtual Event\">
                                    <option value=\"Online\">Online</option>
                                </optgroup>
                            </select>
                        </div>
                    </section>
                    
                    <section style=\"padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;\">
                        <div>
                            <h2>Previous Terns and Conditions</h2>
                            <div>
                                $tnc
                            </div>
                            <h2>Terms and Conditions (If any changes)</h2>
                            <textarea class=\"form-control\" id=\"eTncEditor\" placeholder=\"Edit your TnC here...\" name=\"eTnC\"></textarea>
                        </div>
                        <input type=\"hidden\" value=".$_SESSION['eventUpdate']." name=\"hiddenID\">
                    </section>
                    
                    <div style=\"margin-top: 61px;text-align: center;margin-bottom: 61px;\">
                        <div class=\"btn-group\" role=\"group\"><button class=\"btn btn-secondary\" type=\"button\" style=\"margin-left: 5px;margin-right: 5px;\">Back</button>
                        <button class=\"btn btn-outline-primary\" type=\"submit\" name=\"eRegister\" style=\"margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);color: rgb(255,255,255);\">Submit</button></div>
                    </div>
                        ");
                    }
                }
            ?>
        </form>
    </div>

    <!-- Below template -->
    </div>
    <!-- /.container-fluid -->

    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/createEventJS.js"></script>
    <script src='../tinymce/js/tinymce/tinymce.min.js'></script>
    <script>
        tinymce.init({
        selector: '#eTncEditor',
        toolbar: 'undo redo | styles | bold italic'
        });
        tinymce.init({
        selector: '#eDesceditor',
        toolbar: 'undo redo | styles | bold italic'
        });
    </script>

<?php
    require __DIR__ . '/footer.php'
?>