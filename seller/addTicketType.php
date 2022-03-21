<?php
    require __DIR__ . '/header.php'
?>

<?php
	// if($_SESSION['login'] == false)
	// {
	// 	echo "<script>alert('Login to Continue');
	// 		window.location.href='login.php';</script>";
    // }

    // if($_SESSION['eventID'] == null)
    // {
    //     echo "<script>
 	// 	window.location.href='https://eshop.sgcprototype2.com/seller/createEvent.php';</script>";
    // }
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST["addTicketSubmit"])){
        $tName = mysqli_real_escape_string($conn, SanitizeString($_POST["ticketName"]));
        $tCapacity = mysqli_real_escape_string($conn, SanitizeString($_POST["capacity"]));
        $tPrice = mysqli_real_escape_string($conn, SanitizeString($_POST["price"]));
        $tSalesStart = mysqli_real_escape_string($conn, SanitizeString($_POST["salesStart"]));
        $tsalesEnd = mysqli_real_escape_string($conn, SanitizeString($_POST["salesEnd"]));
        $eventID = 1;//$_SESSION['event']

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
        
        $sql = "INSERT INTO `ticketType`(`ticket_name`, `capacity`, `sales_start`, `sales_end`, `price`, `event_id`) VALUES (?,?,?,?,?,?)";
            if ($stmt = mysqli_prepare($conn,$sql)){
                if(false===$stmt){
                    die('Error with prepare: ') . htmlspecialchars($mysqli->error);
                }
                $bp = mysqli_stmt_bind_param($stmt,"sissdi",$tName,$tCapacity,$tSalesStart,$tsalesEnd,$tPrice,$eventID);
                if(false===$bp){
                    die('Error with bind_param: ') . htmlspecialchars($stmt->error);
                }
                $bp = mysqli_stmt_execute($stmt);
                if ( false===$bp ) {
                    die('Error with execute: ') . htmlspecialchars($stmt->error);
                }
                    if(mysqli_stmt_affected_rows($stmt) == 1){
                        echo "<script>alert('Success!!!!!');</script>";
                        //Add $_SESSION['eventID'] = "";
                        //Add Redirect to next page
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

<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<!-- Select datatable CSS-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

<!-- Select datatable JS-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
    <!-- Above template -->

    <h1 style="margin-top: 50px;">Ticket and Payment Management</h1>
    <div class="d-lg-block d-xl-block d-xxl-block" style="margin-top: 30px;">

        <!-- Add Ticket modal -->
        <div class="modal fade modal-dialog-scrollable" role="dialog" tabindex="-1" id="ticketType_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Ticket Type</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" enctype="multipart/form-data">
                            <div style="margin-bottom: 20px;">
                                <h5>Ticket Name</h5><input class="form-control" type="text" placeholder="Ticket Name" name="ticketName">
                            </div>
                            <div style="margin-bottom: 20px;">
                                <h5>Capacity</h5><input class="form-control" type="text" placeholder="Number of ticket can be sold" name="capacity">
                            </div>
                            <div style="margin-bottom: 20px;">
                                <h5>Price</h5><input class="form-control" type="text" placeholder="Price" name="price">
                            </div>
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-6">
                                    <h5>Sales Start</h5><input class="form-control" id="startDate" type="date" name="salesStart">
                                </div>
                                <div class="col-6">
                                    <h5>Sales End</h5><input class="form-control" id="endDate" type="date" name="salesEnd">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit" style="background: rgb(163, 31, 55);" name="addTicketSubmit">Submit</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Edit Ticket modal -->
        <div class="modal fade modal-dialog-scrollable" role="dialog" tabindex="-1" id="editTicket_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Ticket Type</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div style="margin-bottom: 20px;">
                                <h5>Ticket Name</h5><input class="form-control" id="editTicketName" name="editTicketName" type="text" placeholder="Ticket Name">
                                <input class="form-control" id="editTicketID" name="editTicketID" type="hidden" placeholder="Ticket Name">
                            </div>
                            <div style="margin-bottom: 20px;">
                                <h5>Capacity</h5><input class="form-control" type="text" id="editCapacity" name="editCapacity" placeholder="Number of ticket can be sold">
                            </div>
                            <div style="margin-bottom: 20px;">
                                <h5>Price</h5><input class="form-control" type="text" id="editPrice" name="editPrice" placeholder="Price">
                            </div>
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-6">
                                    <h5>Sales Start</h5><input class="form-control" id="editSalesStart" name="editSalesStart" type="date">
                                </div>
                                <div class="col-6">
                                    <h5>Sales End</h5><input class="form-control" id="editSalesEnd" name="editSalesEnd" type="date">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" id="updateBtn" name = "updateTicket" style="background: rgb(163, 31, 55);">Update</button>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <form>
                                <input class="form-control" id="ticketIDHide" name="ticketIDHide" type="hidden" placeholder="Ticket Name">
                                <button class="btn btn-secondary" type="submit" id="deleteDataBtn" name = "">Delete</button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Main body -->
        <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
            <div>
                <div class="row">
                    <div class="col-sm-3">
                        <h2>Payment and Ticket</h2>
                    </div>
                    <div class="col-sm-2"><button class="btn btn-primary" id="addTicketBtn" type="button" style="background: rgb(163, 31, 55);width: 128.938px;height: 44px;" data-bs-toggle="modal" data-bs-target="#ticketType_modal">Add Ticket</button></div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table" id="ticketTypeList_tbl">
                    <thead>
                        <tr>
                            <th>Ticket Type</th>
                            <th>Capacity</th>
                            <th>Sales Start</th>
                            <th>Sales End</th>
                            <th>Price</th>
                            <th>Ticket ID</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $sql = "SELECT * FROM `ticketType` WHERE `event_id` = {$_SESSION['eventID']}";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {

                                    echo("
                                       <tr>
                                        <td>".$row['ticket_name']."</td>
                                        <td>".$row['capacity']."</td>
                                        <td>".$row['sales_start']."</td>
                                        <td>".$row['sales_end']."</td>
                                        <td>".$row['price']."</td>
                                        <td>".$row['ticketType_id']."</td>
                                        <td><button class=\"btn btn-light btn-sm selectBtn\" type=\"button\" data-bs-toggle=\"modal\" data-bs-target=\"#editTicket_modal\" title=\"Edit\" id=".$row['ticketType_id']."><i class=\"fa fa-edit\"></i></button></td>
                                        </tr>
                                    ");
                                }
                            }

                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <div style="margin-top: 61px;text-align: center;margin-bottom: 61px;">
            <button class="btn btn-primary" type="button" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);">Next</button>
        </div>


    </div>

<!-- Below template -->
</div>
    <!-- /.container-fluid -->

    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/addTicketType.js"></script>
    <script src='../tinymce/js/tinymce/tinymce.min.js'></script>
    <!-- <script>
        tinymce.init({
        selector: '#eTncEditor'
        });
        tinymce.init({
        selector: '#eDesceditor'
        });
    </script> -->

<?php
    require __DIR__ . '/footer.php'
?>