<?php
require __DIR__ . '/header.php'
?>

<?php
    
    if(isset($_GET['eventID']))
    {
        $eID = $_GET['eventID'];
        $_SESSION['eventPurchaseID'] = $_GET['eventID'];
    }
    $eID = $_SESSION['eventPurchaseID'];
?>

<?php
    if(isset($_POST['resendTicket']))
    {
        $tEmail = $_POST["emailTicket"];
        $sqlgetTic = "SELECT * FROM `ticket` 
        INNER JOIN ticketTransaction ON `ticket`.`transaction_id` = `ticketTransaction`.`ticketOrder_id`
        INNER JOIN `event` ON `event`.`event_id` = `ticket`.`event_id` 
        INNER JOIN `ticketType` ON `ticket`.`ticketType_id` = `ticketType`.`ticketType_id`
        WHERE `ticketTransaction`.`buyer_email` = \"$tEmail\"
        AND `ticket`.`event_id`= \"$eID\"";
        $res = mysqli_query($conn, $sqlgetTic);

        if (mysqli_num_rows($res) > 0) {
            while ($row100 = mysqli_fetch_assoc($res)) {
                $buyerEmail = $row100['buyer_email'];
                $eventName = $row100['event_name'];
                $ticketOrderID = $row100['ticketOrder_id'];
                $buyerName = $row100['buyer_name'];
                $ticketType = $row100['ticket_name'];
                $contact = $row100['buyer_contact'];
                $ticketString = $row100['ticket_id'];
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
                    <h3>Thank you for registering in $eventName</h3>
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
                        echo "<script>alert('A purchase confirmation email has been sent to $buyerEmail')</script>";
                    } else {
                        echo "<script>alert('Error')</script>";
                    }
            }
        }
        else
        {
            echo("
            <script>alert(\"No Ticket Found, Please check your ticket ID again\") </script>
            ");
        }

    }

?>

<title>Event Details</title>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="/css/event.css">

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
    <!-- Above Template -->

    <?php
        $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` WHERE `event`.`event_id` = $eID";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $picLocation = "/img/event/" . $row["cover_image"];
                if ($row['event_date'] == $row['eventEnd_date']) {
                    $eventDate = $row['event_date'];
                } else {
                    $eventDate = $row['event_date'] . " - " . $row['eventEnd_date'];
                }
                $eventID = $row['event_id'];
                $desc = html_entity_decode($row['description']);
                $tnc = html_entity_decode($row['event_tnc']);

                //check price
                $sql1 = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` INNER JOIN `ticketType` ON `event`.`event_id` = `ticketType`.`event_id` WHERE `event`.`event_id` = $eID";
                $result1 = mysqli_query($conn, $sql1);
                $minPrice = 999999;
                $maxPrice = 0;
                $buttonPrice = "";

                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        if ($row1['price'] >= $maxPrice) {
                            $maxPrice = $row1['price'];
                        }
                        if ($row1['price'] <= $minPrice) {
                            $minPrice = $row1['price'];
                        }
                    }
                }
                if ($maxPrice == 0) {
                    $buttonPrice = "Free";
                } else if($minPrice == $maxPrice) {
                    $buttonPrice = "RM " . $maxPrice;
                }
                else{
                    $buttonPrice = "RM " . $minPrice . " - RM " . $maxPrice;
                }

                echo ("
                <section class=\"article-clean\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-lg-10 col-xl-8 offset-lg-1 offset-xl-2\">
                            <div class=\"intro\">
                                <h1 class=\"text-center\">".$row['event_name']."</h1>
                                <p class=\"text-center\"><span class=\"by\">Organized by</span> <a href=\"#\">".$row['name']."</a></p>
                                <div class=\"row\">
                                    <div class=\"col-12\"><a href = \"selectTicket.php?eventID=" . $row['event_id'] . "\"><button class=\"btn btn-primary\" type=\"button\" style=\"background: rgb(163, 31, 55);\">Buy Ticket</button></a>
                                    <button class=\"btn btn-primary\" type=\"button\" style=\"background: rgb(30,79,204);margin-left: 10px;\" data-bs-toggle=\"modal\" data-bs-target=\"#resendTicket_modal\">Resend Ticket</button></div>
                                    <div class=\"row\">
                                        <div class=\"col col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-12\"><img style=\"width: 100%;\" src=\"$picLocation\" \"></div>
                                        <div class=\"col col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-12\">
                                            <div class=\"card\">
                                                <div class=\"card-body\">
                                                    <h4 class=\"card-title\">Event Details</h4>
                                                    <div class=\"row\">
                                                        <div class=\"col-2\" style=\"text-align: right;\"><i class=\"fa fa-calendar\"></i></div>
                                                        <div class=\"d-flex d-lg-flex align-items-end justify-content-lg-start align-items-lg-end col-10\" style=\"text-align: left;\">
                                                            <h6 class=\"text-start d-lg-flex\" style=\"margin-bottom: 0px;\">$eventDate</h6>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"col-2\" style=\"text-align: right;\"><i class=\"far fa-clock\"></i></div>
                                                        <div class=\"d-flex d-lg-flex align-items-end justify-content-lg-start align-items-lg-end col-10\" style=\"text-align: left;\">
                                                            <h6 class=\"text-start d-lg-flex\" style=\"margin-bottom: 0px;\">".$row['event_time']." to ".$row['eventEnd_time']."</h6>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"col-2\" style=\"text-align: right;\"><i class=\"far fa-flag\"></i></div>
                                                        <div class=\"d-flex d-lg-flex align-items-end justify-content-lg-start align-items-lg-end col-10\" style=\"text-align: left;\">
                                                            <h6 class=\"text-start d-lg-flex\" style=\"margin-bottom: 0px;\">".$row['category']."</h6>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"col-2\" style=\"text-align: right;\"><i class=\"far fa-money-bill-alt\"></i></div>
                                                        <div class=\"d-flex d-lg-flex align-items-end justify-content-lg-start align-items-lg-end col-10\" style=\"text-align: left;\">
                                                            <h6 class=\"text-start d-lg-flex\" style=\"margin-bottom: 0px;\">$buttonPrice</h6>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"col-2\" style=\"text-align: right;\"><i class=\"fas fa-location-arrow\"></i></div>
                                                        <div class=\"d-flex d-lg-flex align-items-end justify-content-lg-start align-items-lg-end col-10\" style=\"text-align: left;\">
                                                            <h6 class=\"text-start d-lg-flex\" style=\"margin-bottom: 0px;\">".$row['location']."</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style=\"margin-top: 16px;\">
                                        <h3>Event Description</h3>
                                        <div id=\"eventDesc-1\">$desc</div>
                                    </div>
                                    <div style=\"margin-top: 16px;\">
                                        <h3>Terms &amp; Conditions</h3>
                                        <div id=\"eventTnc\">$tnc</div>
                                    </div>
                                    <div class=\"col-12\" style=\"text-align: center;\"><a href = \"selectTicket.php?eventID=" . $row['event_id'] . "\"><button class=\"btn btn-primary\" type=\"button\" style=\"background: rgb(163, 31, 55);\">Buy Ticket</button></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                    ");
            }
        }
        ?>
        <!-- Resend ticket modal -->
        <div class="modal fade modal-dialog-scrollable" role="dialog" tabindex="-1" id="resendTicket_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Resend Ticket</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" enctype="multipart/form-data">
                            <div style="margin-bottom: 20px;">
                                <h5>Buyer Email</h5><input class="form-control" type="email" placeholder="Email" name="emailTicket">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit" style="background: rgb(163, 31, 55);" name="resendTicket">Resend Ticket</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>




    <!-- Below Template -->
</div>
<!-- /.container-fluid -->
<script src="/bootstrap/js/bootstrap.min.js"></script>

<?php
require __DIR__ . '/footer.php'
?>