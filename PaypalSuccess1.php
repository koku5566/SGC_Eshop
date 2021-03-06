<?php
    require __DIR__ . '/header.php'
?>

<?php 
    $paymentid = $_GET['payid'];
		$results = mysqli_query($conn,"SELECT * FROM payments where id='$paymentid'");
		$row1 = mysqli_fetch_array($results);


$uid = $_SESSION['userid'];
$sql ="SELECT product.product_name AS P_name, product.product_price AS P_price, cart.variation_id AS variation_id, 
cart.quantity AS P_quantity, product.product_variation AS P_variation, product.product_stock AS product_stock,
product.product_cover_picture AS P_pic, cart.product_ID AS PID, product.product_status AS P_status, cart.cart_ID AS cart_id, cart.shop_id AS shop_id
FROM `cart`
JOIN `product`
ON product.product_id = cart.product_ID 
JOIN `shopProfile`
ON product.shop_id = shopProfile.shop_id
WHERE cart.user_ID = '$uid' 
AND cart.remove_Product = '0'
AND product.product_status = 'A'
ORDER BY cart.update_at DESC
";

$queryKL = mysqli_query($conn, $sql);


 while ($rowKL = mysqli_fetch_array($queryKL)) {

    $product_stock = 0;
    $product_price = 0;
    $stock_message = "";
    $cart_id = $rowKL['cart_id'];
    $product_id = $rowKL['PID'];
    $product_name = $rowKL['P_name'];
    $product_quantity = $rowKL['P_quantity'];
    $shop_id = $rowKL['shop_id'];

    

    $variation_message = "";
    $showNotif = false;

    if ($rowKL['P_status'] == 'A') {

        if ($rowKL['variation_id'] == "" ) {
            $product_price = $rowKL['P_price'];
            $product_stock = $rowKL['product_stock'];
            $rowKL['variation_id'] = 0;
            $variation_message = "<option selected>Not Variation</option>";
        }
        else if ($rowKL['variation_id'] != "") {
            
            $sql_get_variation_price = "SELECT * FROM `variation` WHERE `variation_id` = '".$rowKL['variation_id']."'";
            $query_get_variation_price = mysqli_query($conn, $sql_get_variation_price);
            while( $row = mysqli_fetch_assoc($query_get_variation_price))
            {
                $product_price = $row['product_price'];
                $product_stock = $row['product_stock'];

                if ($row['product_stock'] == 0) {
                    $showNotif = true;
                    $product_stock = 0;
                    $product_price = 0;

                    $stock_message = "";
                    $stock_message = "OUT fOF STOCK<span id='tpkl[$i]' hidden></span><input class='sub_kl' id='subkl[$i]' type='hidden' value='' readonly>";
                }
            }

            $sql_get_variation = "SELECT * FROM `variation` WHERE `product_id` = '$product_id' AND variation_id = '".$rowKL['variation_id']."'";
            $query_get_variation = mysqli_query($conn, $sql_get_variation);
            while( $row = mysqli_fetch_assoc($query_get_variation))
            {

                if ($row['variation_1_choice'] == "") {
                    $variation_message ="<span value='".$row['variation_id']."' disabled selected>Not Variation</span>";
                }
                else if ($row['variation_1_choice'] != "") {

                    if ($row['variation_id'] == $rowKL['variation_id']) {
                        $variation_message = $variation_message . "<span value='".$row['variation_id']."'>".$row['variation_1_name'].":".$row['variation_1_choice']." - ".$row['variation_2_name'].":".$row['variation_2_choice']."</span>";
                    }
                    else{
                        $variation_message = $variation_message . "<span value='".$row['variation_id']."'>".$row['variation_1_name'].":".$row['variation_1_choice']." - ".$row['variation_2_name'].":".$row['variation_2_choice']."</span>";
                    }
                            
                }
            }

        }

        
        $stock_message = "RM <span id='tpkl[$i]'></span><input class='sub_kl' id='subkl[$i]' type='hidden' value='".$product_price."' readonly>";
    }
    else if ($rowKL['P_status'] != 'A') {
        $showNotif = true;
        $product_stock = 0;
        $product_price = 0;

        $stock_message = "OUT OF STOCK<span id='tpkl[$i]' hidden></span><input class='sub_kl' id='subkl[$i]' type='hidden' value='' readonly>";
    }        

    $invoice_id = $row1['invoice_id'];
    $variation_id= $rowKL['variation_id'];
    $payment_status = $row1['payment_status'];
    $user_address =  $_SESSION['getaddress'];
    $create_time = $row1['createdtime'];
    $userName = $_SESSION['userName'];
    $userEmail = $_SESSION['userEmail'];
    $transaction_id = $row1['transaction_id'];
    $paidAmount = $row1['payment_amount'];

    /* deduct stock */
     $stocksql = "SELECT product_stock, product_sold FROM `product` WHERE product_id = '$product_id'";
    $stockresult = mysqli_query($conn, $stocksql);
    while($row3 = mysqli_fetch_array($stockresult)){
        $stock = $row3['product_stock'];
        $sold = $row3['product_sold'];
    }

    $stocksql2 = "SELECT product_stock FROM `variation`";
    $variationresult = mysqli_query($conn, $stocksql2);
    while($row4 = mysqli_fetch_array($variationresult)){
        $variationStock = $row4['product_stock'];
    }
      

    if ($variation_id == 0) {
    $deductsql = "UPDATE `product` SET `product_stock` = ? WHERE `product_id` = ?";
    if ($stmt2 = mysqli_prepare($conn,$deductsql)){
        $deductQuantity1 = $stock-$product_quantity;
        $bp = mysqli_stmt_bind_param($stmt2,"is",$deductQuantity1,$product_id);
        $bp = mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);
    } 
    $addsql = "UPDATE `product` SET `product_sold` = ? WHERE `product_id` = ?";
    if ($stmt7 = mysqli_prepare($conn,$addsql)){
        $addQuantity1 = $sold+$product_quantity;
        $bp = mysqli_stmt_bind_param($stmt7,"is",$addQuantity1,$product_id);
        $bp = mysqli_stmt_execute($stmt7);
            mysqli_stmt_close($stmt7);       
    }  
    }
    else {
        $deductsql2 = "UPDATE `variation` SET `product_stock` = ? WHERE `variation_id` = ?";
    if ($stmt3 = mysqli_prepare($conn,$deductsql2)){
        $deductQuantity2 = $variationStock-$product_quantity;
        $bp = mysqli_stmt_bind_param($stmt3,"ii",$deductQuantity2,$variation_id);
        $bp = mysqli_stmt_execute($stmt3);
            mysqli_stmt_close($stmt3);
        }
         $addsql2 = "UPDATE `product` SET `product_sold` = ? WHERE `product_id` = ?";
        if ($stmt8 = mysqli_prepare($conn,$addsql2)){
            $addQuantity2 = $sold+$product_quantity;
            $bp = mysqli_stmt_bind_param($stmt8,"is",$addQuantity2,$product_id);
            $bp = mysqli_stmt_execute($stmt8);
                mysqli_stmt_close($stmt8);        
        }  
    } 

/*    echo(" 
        <span>".$invoice_id."</span>
        <span>".$variation_id."</span>
        <span>".$payment_status."</span>
        <span>".$product_id."</span>
        <span>".$product_quantity."</span>
        <span>".$uid."</span>
        <span>".$user_address."</span>
        <span>".$create_time."</span>
        <span>".$shop_id."</span>
        <span>".$date."</span>
        <span>".$paid."</span>


   
    ");    */

     date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("Y-m-d");
    $paid = "Paid";
    $orderid = 1;
    $emptyint = 0;
    $emptystring ="0";
    $null = NULL;
    $shippingMethod = $_SESSION['shippingMethod'];  

/*     echo(" 
    <span>".$date."</span>
    <span>".$paid."</span>
    "); */

    
    $sql2 = "INSERT INTO `productTransaction`(`invoice_id`, `user_id`, `product_id`, `variation_id`, `payment_status`, `address_id`, `shop_id`, `createdtime`, `quantity`) VALUES (?,?,?,?,?,?,?,?,?)";
    if ($stmt = mysqli_prepare($conn, $sql2)) {
        $bp = mysqli_stmt_bind_param($stmt, "sssssissi", $invoice_id, $uid, $product_id, $variation_id, $payment_status, $user_address, $shop_id, $create_time, $product_quantity);
        $bp = mysqli_stmt_execute($stmt);
    }

    $sql4 = "DELETE FROM cart WHERE cart_ID = '$cart_id'";
    if ($stmt5 = mysqli_prepare($conn, $sql4)) {
        $bp = mysqli_stmt_execute($stmt5);
    }
    
}
$sql3 = "INSERT INTO `myOrder`(`user_id`, `userID`,`address_id`, `delivery_method`,`cancellation_status`,`reason_type`, `sku`, `order_date`, `order_status`,`invoice_id`) VALUES (?,?,?,?,?,?,?,?,?,?)";
if ($stmt4 = mysqli_prepare($conn, $sql3)) {
    $bp = mysqli_stmt_bind_param($stmt4, "ssisssssss", $emptystring, $uid, $user_address, $shippingMethod, $emptystring, $emptystring, $emptystring, $date, $paid, $invoice_id);
    $bp = mysqli_stmt_execute($stmt4);
}   
//--CAROL ADD--- (insert to orderStatus tbl )
$sql6 = "INSERT INTO `orderStatus`(`order_id`,`invoice_id`, `status`) VALUES (?,?,?)";
if ($stmt6 = mysqli_prepare($conn, $sql6)) {
    $bp = mysqli_stmt_bind_param($stmt6, "iss", $orderid, $invoice_id , $paid);
    $bp = mysqli_stmt_execute($stmt6);
}    
//-------------

if (mysqli_stmt_affected_rows($stmt) == 1) {
    $to = $userEmail;
    $subject = "Here is your SGC E-Shop Invoice";
    $from = "info@sgcprototype2.com";
    $from2 = "info@sgcprototype2.com";
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
    <h3>Thank You</h3>
    <h5>Your payment has been successful. Below is the details of your transaction </h5>
    <p>Invoice ID:$invoice_id</p>
    <p>Transaction ID:$transaction_id</p>
    <p>Date and Time:$create_time</p>
    <p>Paid Amount: RM $paidAmount</p>
    ";

    $HTMLcontent = "<p><b>Dear $userName</b>,</p><p>$message</p>";

    $boundary = md5(time());
    $headers .= " boundary=\"{$boundary}\"";
    $message = "--{$boundary}\r\n";
    $message .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n";
    $message .= $HTMLcontent . "\r\n";
    $message .= "--{$boundary}\r\n";
    $returnPath = "-f" . $from2;

    if (@mail($to, $subject, $message, $headers, $returnPath)) {

    } else {
        echo "<script>alert('Error')</script>";
    }
} 
else {
    $error = mysqli_stmt_error($stmt);
    echo "<script>alert($error);</script>";
}
mysqli_stmt_close($stmt);

?>
    <link rel="stylesheet" type="text/css" href="css\payment.css">
<!--     <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> -->

<div class="container-fluid" style="width:80%">
    <div class="App">
  <h1>Your Payment has been Successful</h1>
      <h4>Payment Information</h4>
      <p>Reference Number: <?php echo $row1['invoice_id']; ?></p>
      <p>Transaction ID: <?php echo $row1['transaction_id']; ?></p>
      <p>Paid Amount: RM <?php echo $row1['payment_amount']; ?></p>
      <p>Payment Status: <?php echo $row1['payment_status']; ?></p>
      <br>
      <a href ="index.php"> <button class="btn btn-primary text-center" style="text-align: right;background: #A71337;width: 200.95px;">Return to Shop</button></a>
    </div>
  </div>
<br>

<script src="../js/bootstrap.min.js"></script>

  <?php
    require __DIR__ . '/footer.php'
?>
