<?php
require __DIR__ . '/header.php'
?>

<?php
$ticket = $_SESSION['ticketSelected'];
$eID =  $_SESSION['eventPurchaseID'];
$uID = 1; //$_SESSION['id']
$formRecord = $_SESSION['formEntry'];
$price = 0;
?>



<?php
//process payment / store details

if (isset($_POST["completeRegister"])) {

    $buyerName = mysqli_real_escape_string($conn, SanitizeString($_POST["buyerName"]));
    $buyerEmail = mysqli_real_escape_string($conn, SanitizeString($_POST["buyerEmail"]));
    $contact = mysqli_real_escape_string($conn, SanitizeString($_POST["buyerContact"]));
    $paymentID = "free";
    $paymentStatus = "Success";
    $today = date("Y-m-d");
    $now = date("H:i");


    $sql2 = "INSERT INTO `ticketTransaction`(`payment_id`, `payment_status`, `transaction_date`, `transaction_time`, `buyer_name`, `buyer_contact`, `buyer_email`, `total_price`, `form_entry_id`, `ticket_type_id`, `event_id`, `user_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    if ($stmt = mysqli_prepare($conn, $sql2)) {
        if (false === $stmt) {
            die('Error with prepare: ') . htmlspecialchars($mysqli->error);
        }
        $bp = mysqli_stmt_bind_param($stmt, "sssssssdiiii", $paymentID, $paymentStatus, $today, $now, $buyerName,  $contact, $buyerEmail, $price, $formRecord, $ticket, $eID, $uID);
        if (false === $bp) {
            die('Error with bind_param: ') . htmlspecialchars($stmt->error);
        }
        $bp = mysqli_stmt_execute($stmt);
        if (false === $bp) {
            die('Error with execute: ') . htmlspecialchars($stmt->error);
        }
        if (mysqli_stmt_affected_rows($stmt) == 1) {
            $ticketOrderID = mysqli_stmt_insert_id($stmt);
            $ticketString = $ticketOrderID."-".$ticket."-".$eID."-".$formRecord."-".$today.$now;
            $sql3 = "INSERT INTO `ticket`(`ticket_id`, `transaction_id`, `ticketType_id`, `event_id`, `form_entry_id`, `ticketGenerate_Date`, `ticketGenerate_Time`, `user_id`) VALUES (?,?,?,?,?,?,?,?)";
            if ($stmt1 = mysqli_prepare($conn, $sql3)) {
                if (false === $stmt1) {
                    die('Error with prepare: ') . htmlspecialchars($mysqli->error);
                }
                $bp = mysqli_stmt_bind_param($stmt1, "siiiissi", $ticketString, $ticketOrderID, $ticket, $eID, $formRecord, $today, $now, $uID);
                if (false === $bp) {
                    die('Error with bind_param: ') . htmlspecialchars($stmt1->error);
                }
                $bp = mysqli_stmt_execute($stmt1);
                if (false === $bp) {
                    die('Error with execute: ') . htmlspecialchars($stmt1->error);
                }
                if (mysqli_stmt_affected_rows($stmt1) == 1) {
                    $ticketID = mysqli_stmt_insert_id($stmt1);
                    $to = $buyerEmail;
                    $subject = "Event Regisration Completed - " . $eventName;
                    $from = "event@sgcprototype2.com";
                    $from2 = "event@sgcprototype2.com";
                    $fromName = "SGC E-Shop";

                    $headers =  "From: $fromName <$from> \r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: multipart/mixed;\r\n";


                    $message = "
                    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 128' rel='stylesheet'>
                    <style>
                    h2 {
                        font-family: 'Libre Barcode 128';font-size: 22px;
                    }
                    </style>
                    <h3>Thank you for registering in eventName</h3>
                    <h5>Your Transaction Summary</h5>
                    <p>Transaction ID: $ticketOrderID</p>
                    <p>Buyer Name: $buyerName</p>
                    <p>Buyer Email: $buyerEmail</p>
                    <p>Buyer Contact: $contact</p>
                    <p>Total Price: $price</p>
                    <p>Register Event: $eventName</p>
                    <p>Ticket: $ticketType</p>
                    <h5>Barcode below is your ticket for organizer check in purposes. Kindly bookmark this email and keep it safely</h5>
                    <h2>$ticketString</h2>
                    <h4>Thank you</h4>
                    <h4>Best Regards</h4>
                    <h4>SGC Eshop</h4>
			        ";

                    $HTMLcontent = "<p><b>Dear $buyerName</b>,</p><p>$message</p>";

                    $boundary = md5(time());
                    $headers .= " boundary=\"{$boundary}\"";
                    $message = "--{$boundary}\r\n";
                    $message .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
                    $message .= "Content-Transfer-Encoding: 7bit\r\n";
                    $message .= $HTMLcontent . "\r\n";
                    $message .= "--{$boundary}\r\n";
                    $returnPath = "-f" . $from2;

                    if (@mail($to, $subject, $message, $headers, $returnPath)) {
                        echo "<script>alert('Link for reset password has been sent to $buyerEmail')</script>";
                    } else {
                        echo "<script>alert('Error')</script>";
                    }
                    echo "<script>alert('Register Successfully');window.location.href='./registerEventSuccess.php';</script>";
                } else {
                    $error1 = mysqli_stmt_error($stmt1);
                    echo "<script>alert($error1);</script>";
                }
                mysqli_stmt_close($stmt1);
            }
        } else {
            $error = mysqli_stmt_error($stmt);
            echo "<script>alert($error);</script>";
        }
        mysqli_stmt_close($stmt);
    }
}



?>

<title>Register Participant</title>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="/css/event.css">

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
    <!-- Above Template -->

    <h1 class="text-center">Event Checkout</h1>
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Buyer Details</h5>
                </div>
                <div class="card-body">
                    <form action="request2.php" method="POST" enctype="multipart/form-data">
                        <div><label class="form-label">Buyer Name</label><input class="form-control" type="text" placeholder="Buyer Name" name="buyerName" required></div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-6"><label class="form-label">Email</label><input class="form-control" type="email" placeholder="Email" name="buyerEmail" required></div>
                            <div class="col-6"><label class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">+6</span></div><input class="form-control" type="tel" placeholder="012xxxxxxx" name="buyerContact" required>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <div class="col col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
            <div class="card">
                <div class="card-header" style="background: rgb(163, 31, 55);">
                    <h5 class="mb-0" style="color: rgb(255,255,255);">Checkout Summary</h5>
                </div>
                <?php
                $sql = "SELECT * FROM `event` 
                    INNER JOIN `ticketType` 
                    ON `event`.`event_id` = `ticketType`.`event_id` 
                    INNER JOIN `user`
                    ON `event`.`organiser_id` = `user`.`user_id`
                    WHERE `ticketType`.`ticketType_id` = $ticket";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['event_date'] == $row['eventEnd_date']) {
                            $eventDate = $row['event_date'];
                        } else {
                            $eventDate = $row['event_date'] . " - " . $row['eventEnd_date'];
                        }

                        $price = $row['price'];
                        $eventName = $row['event_name'];
                        $ticketType = $row['ticket_name'];


                        echo ("
                            <div class=\"card-body\">
                            <h6 class=\"text-muted card-subtitle mb-2\" style=\"font-size: 20px;\">" . $row['event_name'] . "</h6>
                            <h6 class=\"text-muted card-subtitle mb-2\">" . $row['name'] . "</h6>
                            <div class=\"row\">
                                <div class=\"col-4\">
                                    <p>Event Date:&nbsp;</p>
                                </div>
                                <div class=\"col-8\">
                                    <p>$eventDate</p>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"col-4\">
                                    <p>Ticket:</p>
                                </div>
                                <div class=\"col-8\">
                                    <p>" . $row['ticket_name'] . "</p>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"col-4\">
                                    <p>Price:&nbsp;</p>
                                </div>
                                <div class=\"col-8\">
                                    <p>" . $row['price'] . "</p>
                                    <input type=\"hidden\" name=\"amount\" value =\"$price\">
                                    <input type=\"hidden\" name=\"item_name\" value =\"$eventName\">
                                    <input type=\"hidden\" name=\"item_number\" value =\"$eID\">
                                    
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                            ");

                        if ($row['price'] == 0) {
                            echo ("
                                <div class=\"row\">
                                <div class=\"col\" style=\"text-align: center;\"><button class=\"btn btn-secondary\" type=\"button\">Back</button><button class=\"btn btn-primary\" type=\"submit\" style=\"background: rgb(163, 31, 55); margin-left:5px;\" name=\"completeRegister\">Register</button></div>
                                </div> 
                                ");
                        } else {
                            echo ("
                                <div class=\"row\">
                                <div class=\"col\" style=\"text-align: center;\"><button class=\"btn btn-secondary\" type=\"button\">Back</button><button class=\"btn btn-primary\" type=\"submit\" style=\"background: rgb(163, 31, 55); margin-left:5px;\" name=\"eventPay\">Payment</button></div>
                                </div>
                                ");
                        }
                    }
                }

                ?>

                </form>



                <!-- Below Template -->
            </div>
            <!-- /.container-fluid -->

            <script src="/bootstrap/js/bootstrap.min.js"></script>

            <?php
            require __DIR__ . '/footer.php'
            ?>