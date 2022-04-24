<?php
    require __DIR__ . '/header.php'
?>


<?php 
$ticketid = $_SESSION['ticketTransaction'];

$eventsql = "SELECT ticketTransaction.ticketOrder_id, ticketTransaction.buyer_name, ticketTransaction.buyer_email, ticketTransaction.buyer_contact, ticketTransaction.total_price, ticketTransaction.event_id, ticketTransaction.ticket_type_id,`event`.event_id,
                    `event`.event_name, ticketType.ticketType_id, ticketType.ticket_name
            FROM `ticketTransaction`
            JOIN `event` 
            ON `event`.event_id = ticketTransaction.event_id
            JOIN `ticketType`
            ON ticketType.ticketType_id = ticketTransaction.ticket_type_id
            WHERE ticketTransaction.ticketOrder_id = $ticketid
            ";

$resultsql = mysqli_query($conn, $eventsql);                                             
$row = mysqli_fetch_array($resultsql);

?>
    <link rel="stylesheet" type="text/css" href="css\payment.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<div class="container-fluid" style="width:80%">
<div class="App">
  <h1>Payment Cancelled</h1>
      <br>
      <a href ="index.php"> <button class="btn btn-primary text-center" style="text-align: right;background: #A71337;width: 200.95px;">Return to Shop</button></a>
</div>  
</div>
<br>

<script src="assets/bootstrap/js/bootstrap.min.js"></script>

  <?php
    require __DIR__ . '/footer.php'
?>
