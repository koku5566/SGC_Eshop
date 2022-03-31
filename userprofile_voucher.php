<?php
   require 'localDbConn.php';

   $sql = 
    "SELECT 
     voucher.voucher_id,
     voucher.voucher_code,
     voucher.voucher_startdate,
     voucher.voucher_expired,
     voucher.voucher_type,
     voucher.voucher_details,
     voucher.discount_amount,
     user.shop_name,
     user.shop_profile_image,
     product.product_name

     FROM voucher
     INNER JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id	
     INNER JOIN product ON productVoucher.product_id = product.product_id	
     INNER JOIN user ON product.user_id = user.user_id";	

   $getv = $conn->prepare($sql);
   $getv->execute();
   $result = $getv->get_result();
   
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/classic.css" rel="stylesheet">


<br>
<div class="container">
   <div class="row">
      <?php
      require __DIR__ . '/userprofilenav.php'
      ?>
      <br>
      <div class="col-xl-9">
         <div class="" style="background-color: #ffffff">
            <div class="row row-cols-2 p-5">
               <?php  while ($row = $result->fetch_assoc()) {?>
               <div class="col-6 mt-2 mb-2">
                  <div class="card" id="vouchercard2">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-mb-3 m-2">
                              <img class="m-2" src="../img/<?php echo $row['shop_profile_image']; ?>" id="voucherlogo">
                           </div>
                           <div class="col-mb-7 m-2">
                              <h6 class="card-title"><strong><?php echo $row['shop_name']; ?></strong></h6>
                              <h5 class="card-subtitle text-muted"><?php echo $row['discount_amount']; ?><?php echo $row['voucher_type']; ?> off</h5>
                              <small>Expired:<?php echo $row['voucher_expired']; ?></small><br>
                              <u>
                                 <a type="" class="" data-toggle="modal" data-target="#termsv2Modal<?php echo $row['voucher_id']; ?>">
                                 T&C applied.
                                 </a>
                              </u>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- Modal -->

                  <div class="modal fade" id="termsv2Modal<?php echo $row['voucher_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="termsv2ModalTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="termsv2ModalLongTitle">Terms and Conditions.</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
                           <div class="modal-body">
                              <div class="d-flex justify-content-center">
                                 <div class="card m-2" id="termsvouchercard">
                                    <div class="container">
                                       <img class="mt-4 mb-4" src="../img/<?php echo $row['shop_profile_image']; ?>" id="voucherlogo">
                                    </div>
                                    <div class="card-body">
                                       <h6 class="card-title"><strong><?php echo $row['shop_name']; ?></strong></h6>
                                       <h5 class="card-subtitle text-muted"><?php echo $row['discount_amount']; ?><?php echo $row['voucher_type']; ?> off</h5>
                                       <small>Used : <?php echo $row['voucher_startdate']; ?>~<?php echo $row['voucher_expired']; ?></small><br>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tnccontainer">
                              <strong>Product</strong>
                              <p><?php echo $row['product_name']; ?></p>
                              <strong>More Details</strong>
                              <p><?php echo $row['voucher_details']; ?></p>
                              <strong>Usage Period</strong>
                              <p><?php echo $row['voucher_startdate']; ?> ~ <?php echo $row['voucher_expired']; ?></p>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>

               <?php }?>

            </div>
         </div>
         <br>
      </div>
   </div>
</div>



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
