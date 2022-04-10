<?php
    require __DIR__ . '/header.php'
?>
    <link rel="stylesheet" type="text/css" href="css\payment.css">
    <div class="container-fluid" style="width:80%">

<?php 
include_once 'db_connection.php'; 
?>

<div class="payment">
  <h1>Checkout</h1>
  <?php
  $result = mysqli_query($db_conn,"SELECT * FROM user where name='jordan'");
  while($row = mysqli_fetch_array($result)){
  ?>
  <h3><?php echo $row['name'];?></h3>
  <h3><?php echo $row['address']," ",$row['postal_code']," ",$row['area']," ",$row['state']," ",$row['country'];?></h3>
  <?php } ?> 

  <div class="wrapper">
    <?php 
		  $results = mysqli_query($db_conn,"SELECT * FROM products where status=1");
		  while($row = mysqli_fetch_array($results)){
    ?>
	    <div class="col__box">
	      <h5><?php echo $row['name']; ?></h5>
        <h6>Price: <span> $<?php echo $row['price']; ?> </span> </h6>
        <form class="paypal" action="request.php" method="post" id="paypal_form">
          <input type="hidden" name="item_number" value="<?php echo $row['id']; ?>" >
          <input type="hidden" name="item_name" value="<?php echo $row['name']; ?>" >
          <input type="hidden" name="amount" value="<?php echo $row['price']; ?>" >
          <input type="hidden" name="currency_code" value="MYR" >
          <input type="submit" name="submit" value="Buy Now" class="btn__default">
          <?php
  $result = mysqli_query($db_conn,"SELECT * FROM user where name='jordan'");
  while($row = mysqli_fetch_array($result)){
  ?>
          <input type="hidden" name="username" value="<?php echo $row['name']; ?>" >
          <input type="hidden" name="address" value="<?php echo $row['address']; ?>" >
          <input type="hidden" name="postal_code" value="<?php echo $row['postal_code']; ?>" >
          <input type="hidden" name="state" value="<?php echo $row['state']; ?>" >
          <input type="hidden" name="country" value="<?php echo $row['country']; ?>" >
  <?php } ?> 
        </form>
	    </div>
    <?php } ?>
  </div>
  </div> 
  <?php
    require __DIR__ . '/footer.php'
?>
