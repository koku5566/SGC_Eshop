<?php
   require 'localDbConn.php';

   $result = mysqli_query($conn,
    "SELECT V.voucher_code, V.voucher_startdate
     FROM voucher V
     INNER JOIN vouchertype VT
     ON V.voucher_type_id = VT.voucher_type_id ");	

   while($row = mysqli_fetch_array($result)){

      // $rows[] = $row;
   // echo json_encode ($rows['voucher_code']);
   // echo json_encode ($rows[0]);
   
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<link href="/css/voucher.css" rel="stylesheet" type="text/css">

<div class="card" id="vouchercard">
   <div class="container">
      <img class="m-4" src="../img/segilogo.png" id="voucherlogo">
   </div>
   <div class="card-body">
      <h6 class="card-title"><strong><?php echo $row['voucher_code']; ?></strong></h6>
      <h5 class="card-subtitle text-muted"><?php ?>off</h5>
      <small>Used : </small><br>
      <u>
         <a type="" class="" data-toggle="modal" data-target="#termsModal">
         T&C applied.
         </a>
      </u>
   </div>
   <div class="card-footer">
      <button type="button" class="btn btn-warning btn-sm" style="float: right" data-toggle="modal" data-target="#alert">CLAIM</button>
   </div>
</div>

<?php } ?>