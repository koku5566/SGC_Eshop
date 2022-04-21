<?php
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ItemList; 

require __DIR__. '/header.php';
require __DIR__. '/paypalConfig.php';

date_default_timezone_set("Asia/Kuala_Lumpur");
$ticket = $_SESSION['ticketSelected'];
$eID =  $_SESSION['eventPurchaseID'];
$uID = 1; //$_SESSION['id']
$formRecord = $_SESSION['formEntry'];
$price = 0;
$eventName = $_SESSION['eventName'];
$ticketType = $_SESSION['ticketType'];

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
            $_SESSION['ticketTransaction'] = $ticketOrderID;
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
                    
                    $sql5 = "SELECT * FROM `ticketType` WHERE `ticketType_id` = $ticket";
                    $result5 = mysqli_query($conn, $sql5);
                    $row5 = mysqli_fetch_assoc($result5);
                    $currentUpdateQtt = $row5['current_quantity']-1;


                    $sqlupdate = "UPDATE `ticketType` SET `current_quantity`=? WHERE `ticketType_id` = ?";
                    if ($stmt5 = mysqli_prepare($conn,$sqlupdate)){
                        if(false===$stmt5){
                            die('Error with prepare: ') . htmlspecialchars($mysqli->error);
                        }
                        $bp = mysqli_stmt_bind_param($stmt5,"ii",$currentUpdateQtt,$ticket);
                        if(false===$bp){
                            die('Error with bind_param: ') . htmlspecialchars($stmt5->error);
                        }
                        $bp = mysqli_stmt_execute($stmt5);
                        if ( false===$bp ) {
                            die('Error with execute: ') . htmlspecialchars($stmt5->error);
                        }
                            if(mysqli_stmt_affected_rows($stmt5) == 1){

                            }
                            else{
                                $error = mysqli_stmt_error($stmt5);
                                echo "<script>alert(".$row5['current_quantity'].");</script>";
                            }		
                            mysqli_stmt_close($stmt5);
                    }

                    $picLocation = "/img/event/1649595721697.png";
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
                    <img src=\"$picLocation\" style\"width:100%;\">
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


if (empty($_POST['item_number'])) {
    throw new Exception('This script should not be called directly, expected post data');
}

if (isset($_POST["eventPay"])) {
    $buyerName = mysqli_real_escape_string($conn, SanitizeString($_POST["buyerName"]));
    $buyerEmail = mysqli_real_escape_string($conn, SanitizeString($_POST["buyerEmail"]));
    $contact = mysqli_real_escape_string($conn, SanitizeString($_POST["buyerContact"]));

    $_SESSION['buyerName'] = $buyerName;
    $_SESSION['buyerEmail'] = $buyerEmail;
    $_SESSION['buyerContact'] = $contact;

    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
    // Set some example data for the payment.
    $currency = 'MYR';
    $item_qty = 1;
    $amountPayable = $_POST['amount'];
    $product_name = $_POST['item_name'];
    $item_code = $_POST['item_number'];
    $description = 'Paypal transaction';
    $invoiceNumber = uniqid();
    $my_items = array(
        array('name'=> $product_name, 'quantity'=> $item_qty, 'price'=> $amountPayable, 'sku'=> $item_code, 'currency'=> $currency)
    );
        
    $amount = new Amount();
    $amount->setCurrency($currency)
        ->setTotal($amountPayable);
    
    $items = new ItemList();
    $items->setItems($my_items);
        
    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setDescription($description)
        ->setInvoiceNumber($invoiceNumber)
        ->setItemList($items);
    
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl($paypalConfig['return_url'])
        ->setCancelUrl($paypalConfig['cancel_url']);
    
    $payment = new Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions([$transaction])
        ->setRedirectUrls($redirectUrls);
    
    try {
        $payment->create($apiContext);
    } catch (Exception $e) {
        throw new Exception('Unable to create link for payment');
    }
    
    $redirect = $payment->getApprovalLink();
    echo ("
    <script> window.location.href=\"$redirect\" </script>
    ");
    exit(1);

}



