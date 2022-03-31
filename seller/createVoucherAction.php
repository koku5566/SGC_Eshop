<?php
   require '../localDbConn.php';

   if(isset($_POST['submit'])){

      $voucherCode = $_POST['voucherCode'];
      $voucherStartdate = $_POST['voucherStartdate'];
      $voucherExpired = $_POST['voucherExpired'];
      $discountAmount = $_POST['discountAmount'];
      $voucherLimit = $_POST['voucherLimit'];
      $voucherType = $_POST['voucherType'];
      $voucherDetails = $_POST['voucherDetails'];
      $voucherDisplay = $_POST['voucherDisplay'];
      $date = date('Y-m-d H:i:s');


      $sqlv = "INSERT INTO voucher (voucher_code, voucher_startdate, voucher_expired, discount_amount, voucher_limit, voucher_details, voucher_display, voucher_type, created_at)
               VALUES ('$voucherCode', '$voucherStartdate', '$voucherExpired', '$discountAmount', '$voucherLimit', '$voucherDetails', '$voucherDisplay', '$voucherType', '$date');";

      mysqli_query($conn, $sqlv);

      header("Location: ../seller/createVoucher.php");

   }
   else {
      echo "error";
   }
   
?>