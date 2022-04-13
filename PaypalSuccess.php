
<?php
    require __DIR__ . '/header.php'
?>
    <link rel="stylesheet" type="text/css" href="css\payment.css">
</head>
<div class="payment">
  <h1>Your Payment has been Successful</h1>
  <div class="wrapper">
  <?php 
    $paymentid = $_GET['payid'];
		$results = mysqli_query($db_conn,"SELECT * FROM payments where id='$paymentid' ");
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

  <?php
    require __DIR__ . '/footer.php'
?>
