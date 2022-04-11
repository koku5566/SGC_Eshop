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


      $product = $_POST['productlist'];
      $v = mysqli_insert_id($conn);//specific table

      for($i = 0; $i < count($product); $i++){

         $sqlpv = "INSERT INTO productvoucher (product_id, voucher_id)
                  VALUES ('".$product[$i]."', '$v');"; //get prod first array

         mysqli_query($conn, $sqlpv);
         
      }
       if($query_run)
       {
          $_SESSION['status'] = "Multiple Data Inserted Successfully";
          header("Location: ../seller/createVoucher.php");
          exit(0);
       }
       else
       {
          $_SESSION['status'] = "Data Not Inserted";
          header("Location: ../seller/createVoucher.php");
          exit(0);
       }

    }
    else {
       echo "error";
    }
   
   
?>
