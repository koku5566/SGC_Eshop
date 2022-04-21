<?php
    require __DIR__ . '/header.php'
?>

<?php 
    $paymentid = $_GET['payid'];
		$results = mysqli_query($conn,"SELECT * FROM payments where id='$paymentid'");
		$row1 = mysqli_fetch_array($results);

$uid = "U000018";
$sql ="SELECT product.product_name AS P_name, product.product_price AS P_price, cart.variation_id AS variation_id, 
cart.quantity AS P_quantity, product.product_variation AS P_variation, product.product_stock AS product_stock,
product.product_cover_picture AS P_pic, cart.product_ID AS PID, product.product_status AS P_status, cart.cart_ID AS cart_id
FROM `cart`
JOIN `product`
ON product.product_id = cart.product_ID 
JOIN `shopProfile`
ON product.shop_id = shopProfile.shop_id
WHERE cart.user_ID = '$uid' 
AND cart.shop_id = 14
AND cart.remove_Product = '0'
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

            $sql_get_variation = "SELECT * FROM `variation` WHERE `variation_id` = '".$rowKL['variation_id']."'";
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



/*    echo(" 
        <span>".$invoice_id."</span>
        <span>".$variation_id."</span>
        <span>".$payment_status."</span>
        <span>".$product_id."</span>
        <span>".$uid."</span>
        <span>".$user_address."</span>
        <span>".$create_time."</span>

   
    "); */

    
    $sql2 = "INSERT INTO `productTransaction`(`invoice_id`, `user_id`, `product_id`, `variation_id`, `payment_status`, `address_id`, `createdtime`,`shop_id`) VALUES (?,?,?,?,?,?,?,?)";
    if ($stmt = mysqli_prepare($conn, $sql2)) {
        $bp = mysqli_stmt_bind_param($stmt, "sssssis", $invoice_id, $uid, $product_id, $variation_id, $payment_status, $user_address, $create_time,$shop_id);
        $bp = mysqli_stmt_execute($stmt);
    }
    else {
        $error = mysqli_stmt_error($stmt);
        echo "<script>alert($error);</script>";
    mysqli_stmt_close($stmt);
    }
}





?>
    <link rel="stylesheet" type="text/css" href="css\payment.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<div class="container-fluid" style="width:80%">
    <div class="App">
  <h1>Your Payment has been Successful</h1>
      <h4>Payment Information</h4>
      <p>Reference Number: <?php echo $row1['invoice_id']; ?></p>
      <p>Transaction ID: <?php echo $row1['transaction_id']; ?></p>
      <p>Paid Amount: <?php echo $row1['payment_amount']; ?></p>
      <p>Payment Status: <?php echo $row1['payment_status']; ?></p>
      <h4>Product Information</h4>
      <p>Product id: <?php echo $row1['product_id']; ?></p>
      <p>Product Name: <?php echo $row1['product_name']; ?></p>
    </div>
    <br>
    <a href ="index.php"> <button class="btn btn-primary text-center" style="text-align: right;background: #A71337;width: 200.95px;">Return to Shop</button></a>
  </div>
<br>

<script src="assets/bootstrap/js/bootstrap.min.js"></script>

  <?php
    require __DIR__ . '/footer.php'
?>
