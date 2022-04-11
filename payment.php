<?php
    require __DIR__ . '/header.php'
?>
    <link rel="stylesheet" type="text/css" href="css\payment.css">
    <div class="container-fluid" style="width:80%">


<div class="payment">
  <h1>Payment</h1>
  <?php
  $result = mysqli_query($conn,"SELECT * FROM user where name='test'");
  while($row = mysqli_fetch_array($result)){
  ?>
  <h3>User: <?php echo $row['name'];?></h3>
  <?php } ?> 


   <div class="wrapper">
    <?php 
		  $results = mysqli_query($conn,"SELECT * FROM product where product_id='P000035'");
		  while($row = mysqli_fetch_array($results)){
    ?>
	    <div class="col__box">
	      <h5><?php echo $row['product_name']; ?></h5>
        <h6>Price: <span> $<?php echo $row['product_price']; ?> </span> </h6>
        <form class="paypal" action="request.php" method="post" id="paypal_form">
          <input type="hidden" name="item_number" value="<?php echo $row['product_id']; ?>" >
          <input type="hidden" name="item_name" value="<?php echo $row['product_name']; ?>" >
          <input type="hidden" name="amount" value="<?php echo $row['product_price']; ?>" >
          <input type="hidden" name="currency_code" value="MYR" >
          <input type="submit" name="submit" value="Pay" class="btn__default">
        </form>
	    </div>
    <?php } ?>
  </div>
  </div> 

  <?php
    require __DIR__ . '/footer.php'
?>
