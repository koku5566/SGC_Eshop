<?php require __DIR__ . '/header.php' ?>

<?php	
	if($_SESSION['login'] == false)
	{
		?><script>window.location = '<?php echo("$domain/login.php");?>'</script><?php
		exit;
    }
?>

<?php

   // $sql_voucher =
   // "SELECT 
   // voucher.voucher_id,
   // voucher.voucher_code,
   // voucher.voucher_type,
   // voucher.discount_amount,
   // voucher.voucher_startdate,
   // voucher.voucher_expired,
   // voucher.voucher_details,
   // shopProfile.shop_name,
   // shopProfile.shop_profile_image,
   // product.product_name

   // FROM voucher
   // JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id	
   // JOIN product ON productVoucher.product_id = product.product_id		
   // JOIN shopProfile ON product.shop_id	= shopProfile.shop_id
   // -- GROUP BY voucher.voucher_id
   // "; 

   // $stmt = $conn->prepare($sql_voucher);
   // $stmt->execute();
   // $result = $stmt->get_result();

   // while ($row = $result->fetch_assoc()) {
   
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Custom styles for this template-->

<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/classic.css" rel="stylesheet">


<br>
<div class="container">
   <div class="row">
      <?php require __DIR__ . '/userprofilenav.php' ?><br>
      <div class="bg-gradient col-xl-9" style="margin-top: -1.5rem !important;">
         <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
               <div class="col-xl-12 col-lg-6 col-md-9">
                  <div class="card o-hidden border-0 shadow-lg my-5">
                     <div class="card-body p-0">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php require __DIR__ . '/footer.php' ?>




<style>
#voucherlogo{
   height: 100px;
   width: 100px;
   display: flex;
   justify-content: center;
   overflow: hidden
}

#voucherlogo img {
   width: 100px
}

img {
   width: 100px
}

#termsvouchercard{
   width: 11.5rem;
   height: 20rem;
}

.tnccontainer{
   margin: 10px 30px 30px 30px;
   padding: 15px 18px 15px 18px;
   border-radius: 10px;
   border: dashed;
}

.selectvoucher{
   width: 40px;
   height: 28px;
}

#vouchercard2{
   width: 22rem;
   height: 10.5rem;
}
</style>
