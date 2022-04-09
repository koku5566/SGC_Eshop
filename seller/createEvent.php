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
    if($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST["eRegister"])){
        //echo "<script>alert('the script is running.....');</script>";
        //$checkImage = getimagesize($_FILES["coverImage"]["tmp_name"]);
        //if($checkImage !== false)
        //{
            $coverIMG = $_FILES['coverImage']['tmp_name'];
            $imageProperties = getimageSize($_FILES['coverImage']['tmp_name']);
            $coverImgContent = addslashes(file_get_contents($coverIMG));
        //}
        $eTitle = mysqli_real_escape_string($conn, SanitizeString($_POST["eventTitle"]));
        $eDateFrom = mysqli_real_escape_string($conn, SanitizeString($_POST["eDate_From"]));
        $eDateTo = mysqli_real_escape_string($conn, SanitizeString($_POST["eDate_To"]));
        $eTimeFrom = mysqli_real_escape_string($conn, SanitizeString($_POST["eTime_From"]));
        $eTimeTo = mysqli_real_escape_string($conn, SanitizeString($_POST["eTime_To"]));
        $eDes = htmlentities($_POST["eDesc"]); //decode using stripslashes
        $eCat = mysqli_real_escape_string($conn, SanitizeString($_POST["eCategory"]));
        $eLoc = mysqli_real_escape_string($conn, SanitizeString($_POST["eLocation"]));
        $eTnc = htmlentities($_POST["eTnC"]);//decode using html_entity_decode()
        $eOrganiser = 1;//mysqli_real_escape_string($conn, SanitizeString($_SESSION["eLocation"]));

        // $check = "SELECT * FROM `event`";
        // if($stmt = mysqli_prepare ($conn, $check)){
        //   mysqli_stmt_execute($stmt);
        //   mysqli_stmt_bind_result($stmt, $c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12);

        //   while(mysqli_stmt_fetch($stmt)){
        //       if($eTitle == $c3)
        //       {
        //         echo "<script>alert('This Event seems to be in our database, check yo');window.location.href='seller/dashboard.php';</script>";
        //       }
        //   }
        //   mysqli_stmt_close($stmt);
        // }
        
        $sql = "INSERT INTO `event`(`cover_image`, `cover_image_type`, `event_name`, `event_date`, `eventEnd_date`, `event_time`, `eventEnd_time`, `description`, `category`, `location`, `event_tnc`, `organiser_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($conn,$sql)){
                if(false===$stmt){
                    die('Error with prepare: ') . htmlspecialchars($mysqli->error);
                }
                $bp = mysqli_stmt_bind_param($stmt,"bssssssssssi",$coverImgContent, $imageProperties['mime'], $eTitle,$eDateFrom,$eDateTo,$eTimeFrom,$eTimeTo,$eDes,$eCat,$eLoc,$eTnc,$eOrganiser);
                mysqli_stmt_send_long_data($stmt,0,$coverImgContent);
                if(false===$bp){
                    die('Error with bind_param: ') . htmlspecialchars($stmt->error);
                }
                $bp = mysqli_stmt_execute($stmt);
                if ( false===$bp ) {
                    die('Error with execute: ') . htmlspecialchars($stmt->error);
                }
                    if(mysqli_stmt_affected_rows($stmt) == 1){
                        $prevID = mysqli_stmt_insert_id($stmt);
                        echo "<script>alert('Success!!!!!' + $prevID);window.location.href='./addTicketType.php';</script>";
                        $_SESSION['eventID'] = $prevID;
                    }
                    else{
                        $error = mysqli_stmt_error($stmt);
                        echo "<script>alert($error);</script>";
                    }		
                    mysqli_stmt_close($stmt);
            }
          }
?>

<title>Create Event</title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="../css/event.css">


    <!-- Begin Page Content -->
    <div class="container-fluid" style="width:80%">
    <!-- Above template -->

    <h1 style="margin-top: 50px;">Create New Event</h1>
    <div class="d-lg-block d-xl-block d-xxl-block" style="margin-top: 30px;">
        
        <!-- Form for create new event -->
        <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" enctype="multipart/form-data">
            
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <h2>Cover Image<input class="form-control" type="file" id="coverImg" style="margin-top: 10px;" name="coverImage" required></h2>
            </section>
            
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <h2>Event Details</h2>
                <h3 style="margin-top: 30px;">Event Title<input class="form-control" type="text" required placeholder="Event Title" style="margin-top: 10px;" name="eventTitle"></h3>
                <div>
                    <div class="row">
                        <div class="col-sm-2">
                            <h3 style="margin-top: 30px;width: 100%;">Event Date</h3>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-check" style="width: 100%;margin-top: 44px;"><input class="form-check-input" type="checkbox" id="oneDayEvent_check"><label class="form-check-label" for="formCheck-1"><strong>One-Day Event</strong></label></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5"><input class="form-control" type="date" name="eDate_From" id="eStartDate" required></div>
                        <div class="col-sm-2">
                            <h5 style="text-align: center;margin-top: 6px;">To</h5>
                        </div>
                        <div class="col-sm-5"><input class="form-control" type="date" name="eDate_To" id="eEndDate" required></div>
                    </div>
                </div>
                <div>
                    <h3 style="margin-top: 30px;width: 100%;">Event Time</h3>
                    <div class="row">
                        <div class="col-sm-5"><input class="form-control" type="time" name="eTime_From" required></div>
                        <div class="col-sm-2">
                            <h5 style="text-align: center;margin-top: 6px;">To</h5>
                        </div>
                        <div class="col-sm-5"><input class="form-control" type="time" name="eTime_To" required></div>
                    </div>
                </div>
                <div style="margin-top: 30px;">
                    <h3>Description</h3>
                    <textarea class="form-control" id="eDesceditor" placeholder="Edit your description here..." name="eDesc"></textarea>
                </div>
                <div style="margin-top: 30px;">
                    <h3>Category</h3><input class="form-control" type="text" name="eCategory">
                </div>
                <div>
                    <div class="row">
                        <div class="col-sm-2">
                            <h3 style="margin-top: 30px;width: 100%;">Location</h3>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-check" style="width: 100%;margin-top: 44px;"><input class="form-check-input" type="checkbox" id="onlineCheck"><label class="form-check-label" for="oneDayEvent_check-1"><strong>Online Event</strong></label></div>
                        </div>
                    </div><select class="form-select" name="eLocation" id="optionLocation">
                        <optgroup label="Northern Region">
                            <option value="Perlis">Perlis</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Pulau Pinang">Pulau Pinang</option>
                            <option value="Perak">Perak</option>
                        </optgroup>
                        <optgroup label="Central Region">
                            <option value="Selangor">Selangor</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Putrajaya">Putrajaya</option>
                        </optgroup>
                        <optgroup label="East Coast Region">
                            <option value="Kelantan">Kelantan</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="Pahang">Pahang</option>
                        </optgroup>
                        <optgroup label="Southern Region">
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Johor" selected="">Johor</option>
                        </optgroup>
                        <optgroup label="East Malaysia">
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Labuan">Labuan</option>
                        </optgroup>
                        <optgroup label="Virtual Event">
                            <option value="Online">Online</option>
                        </optgroup>
                    </select>
                </div>
            </section>
            
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <div>
                    <h2>Terms and Conditions</h2>
                    <textarea class="form-control" id="eTncEditor" placeholder="Edit your TnC here..." name="eTnC"></textarea>
                </div>
            </section>
            
            <div style="margin-top: 61px;text-align: center;margin-bottom: 61px;">
                <div class="btn-group" role="group"><button class="btn btn-secondary" type="button" style="margin-left: 5px;margin-right: 5px;">Back</button>
                <button class="btn btn-outline-primary" type="submit" name="eRegister" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);color: rgb(255,255,255);">Submit</button></div>
            </div>
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
        selector: '#eTncEditor'
        });
        tinymce.init({
        selector: '#eDesceditor'
        });
    </script>

<?php
    require __DIR__ . '/footer.php'
?>