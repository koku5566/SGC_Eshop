<?php
    require __DIR__ . '/header.php'
?>

<?php 
    $paymentid = $_GET['payid'];
		$results = mysqli_query($conn,"SELECT * FROM payments where id='$paymentid'");
		$row = mysqli_fetch_array($results);
?>


<?php  
date_default_timezone_set("Asia/Kuala_Lumpur");
$ticket = $_SESSION['ticketSelected'];
$eID =  $_SESSION['eventPurchaseID'];
$uID = 1; //$_SESSION['id']
$formRecord = $_SESSION['formEntry'];
$price = 0;


    $buyerName = $_SESSION['buyerName'];
    $buyerEmail = $_SESSION['buyerEmail'];
    $contact = $_SESSION['buyerContact'];
    $paymentID = $row['transaction_id'];
    $paymentStatus = $row['payment_status'];
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
                        echo "<script>alert('A purchase confirmation email has been sent to $buyerEmail')</script>";
                    } else {
                        echo "<script>alert('Error')</script>";
                    }
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


?>
    <link rel="stylesheet" type="text/css" href="css\payment.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<div class="container-fluid" style="width:80%">

<div class="App">
  <h1>Your Payment has been Successful</h1>  
	  <div class="status">
      <h4>Payment Information</h4>
      <p>Reference Number: <?php echo $row['invoice_id']; ?></p>
      <p>Transaction ID: <?php echo $row['transaction_id']; ?></p>
      <p>Paid Amount: <?php echo $row['payment_amount']; ?></p>
      <p>Payment Status: <?php echo $row['payment_status']; ?></p>
      <h4>Product Information</h4>
      <p>Product id: <?php echo $row['product_id']; ?></p>
      <p>Product Name: <?php echo $row['product_name']; ?></p>
      <br>
      <a href ="index.php"> <button class="btn btn-primary text-center" style="text-align: right;background: #A71337;width: 200.95px;">Return to Shop</button></a>
    </div>
  </div>
<br>

<script src="assets/bootstrap/js/bootstrap.min.js"></script>

  <?php
    require __DIR__ . '/footer.php'
?>
