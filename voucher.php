<?php
   require __DIR__ . '/header.php'
?>

<?php

   $res = mysqli_query($conn, "SELECT v.*, t.* FROM voucher v, voucherType vt WHERE v.voucher_type_id=t.voucher_type_id");

   while($row=mysql_fetch_array($res))
   {
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
      <h6 class="card-title"><strong>SEGi Group of Colleges</strong></h6>
      <h5 class="card-subtitle text-muted"><?php echo $row['voucher_type'];?><?php echo $row['discount_amount'];?> off</h5>
      <small>Used : <?php echo $row['voucher_startdate'];?></small><br>
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
<?php 
}
?>