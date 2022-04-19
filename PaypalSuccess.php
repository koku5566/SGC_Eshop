<?php
    require __DIR__ . '/header.php'
?>
    <link rel="stylesheet" type="text/css" href="css\payment.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<div class="container-fluid" style="width:80%">
<div class="payment">
  <div class="wrapper" style="background: #f1f7fc;">
  <h1>Your Payment has been Successful</h1>
  <?php 
    $paymentid = $_GET['payid'];
		$results = mysqli_query($conn,"SELECT * FROM payments where id='$paymentid' ");
		$row = mysqli_fetch_array($results);
  ?>
	  <div class="status">
      <h4>Payment Information</h4>
      <p>Reference Number: <?php echo $row['invoice_id']; ?></p>
      <p>Transaction ID: <?php echo $row['transaction_id']; ?></p>
      <p>Paid Amount: <?php echo $row['payment_amount']; ?></p>
      <p>Payment Status: <?php echo $row['payment_status']; ?></p>
      <h4>Product Information</h4>
      <p>Product id: <?php echo $row['product_id']; ?></p>
      <p>Product Name: <?php echo $row['product_name']; ?></p>
    </div>
  </div>
</div>  
</div>

<script src="assets/bootstrap/js/bootstrap.min.js"></script>

  <?php
    require __DIR__ . '/footer.php'
?>
