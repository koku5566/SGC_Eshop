<?php
    require __DIR__ . '/header.php'
?>


<?php  
$eventsql = "SELECT ticketTransaction.ticketOrder_id, ticketTransaction.buyer_name, ticketTransaction.buyer_email, ticketTransaction.buyer_contact, ticketTransaction.total_price, ticketTransaction.event_id, ticketTransaction.ticket_type_id,`event`.event_id,
                    `event`.event_name, ticketType.ticketType_id, ticketType.ticket_name
            FROM `ticketTransaction`
            JOIN `event` 
            ON `event`.event_id = ticketTransaction.event_id
            JOIN `ticketType`
            ON ticketType.ticketType_id = ticketTransaction.ticket_type_id
            WHERE ticketTransaction.ticketOrder_id = $_SESSION[ticketTransaction];
            ";

$resultsql = mysqli_query($conn, $eventsql);                                             
$row = mysqli_fetch_array($results);

?>
    <link rel="stylesheet" type="text/css" href="css\payment.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<div class="container-fluid" style="width:80%">
<div class="payment">
  <div class="wrapper" style="background: #f1f7fc;">
  <h1>Register Successful</h1>
  
	  <div class="status">
      <h4>Information</h4>
      <p>Transcation ID: <?php echo $row['ticketTransaction.ticketOrder_id']; ?></p>
      <p>Buyer Name: <?php echo $row['ticketTransaction.buyer_name']; ?></p>
      <p>Buyer Email: <?php echo $row['ticketTransaction.buyer_email']; ?></p>
      <p>Buyer Contact: <?php echo $row['ticketTransaction.buyer_contact']; ?></p>
      <p>Total Price: <?php echo $row['ticketTransaction.total_price']; ?></p>
      <p>Register Event: <?php echo $row['`event`.event_name']; ?></p>
      <p>Ticket: <?php echo $row['ticketType.ticket_name']; ?></p>
    </div>
  </div>
</div>  
</div>

<script src="assets/bootstrap/js/bootstrap.min.js"></script>

  <?php
    require __DIR__ . '/footer.php'
?>
