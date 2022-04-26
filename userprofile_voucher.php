<?php
    require __DIR__ . '/header.php';
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
   
<div class="row">
   <?php require __DIR__ . '/userprofilenav.php' ?>
   <div class="bg-gradient col-xl-9" style="margin-top: -1.5rem !important;">
      <div class="container">
         <!-- Outer Row -->
         <div class="row justify-content-center">
               <div class="col-xl-12 col-lg-6 col-md-9">
                  <div class="card o-hidden border-0 shadow-lg my-5">
                     <div class="card-body p-0">
                           <!-- Nested Row within Card Body -->
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="p-5">
                                    <div class="text-left">
                                       <div class="h1 text-gray-900 mb-4 container-left-col2">My Voucher</div>
                                    </div>
                                    <hr>
                                    <?php

                                       $userid = $_SESSION["userid"];

                                      $sql_voucherR =
                                      "SELECT 
                                      voucherRedemption.voucher_id,
                                      voucherRedemption.user_id,
                                      voucher.voucher_id,
                                      voucher.voucher_code,
                                      voucher.voucher_type,
                                      voucher.discount_amount,
                                      voucher.voucher_display,
                                      voucher.voucher_limit,
                                      voucher.voucher_list,
                                      voucher.voucher_startdate,
                                      voucher.voucher_expired,
                                      voucher.voucher_details,
                                      shopProfile.shop_name,
                                      shopProfile.shop_id,
                                      shopProfile.shop_profile_image
                                     
                                      FROM voucherRedemption
                                      JOIN voucher ON voucherRedemption.voucher_id = voucher.voucher_id
                                      JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id
                                      JOIN product ON productVoucher.product_id = product.product_id
                                      JOIN shopProfile ON product.shop_id = shopProfile.shop_id
                                      WHERE voucherRedemption.user_id = '$userid'
                                      GROUP BY voucher.voucher_id, shopProfile.shop_name, shopProfile.shop_profile_image, shopProfile.shop_id, voucherRedemption.voucher_id, voucherRedemption.user_id
                                      ";
                                     
                                       $result_upvoucher = mysqli_query($conn, $sql_voucherR);

                                       while ($row = mysqli_fetch_assoc($result_upvoucher)) {

                                          $td = date('y-m-d');
                                          $expr = $row['voucher_expired'];
                                          
                                          $today = strtotime($td);
                                          $expired = strtotime($expr);

                                          if($row['voucher_display'] == 1 && $row['voucher_list'] == 1 && $row['voucher_limit'] > 0 && $expired > $today ){
                                    ?>
                                    <div class="col-sm-12">
                                       <div class="card m-2">
                                          <div class="card-body">
                                             <div class="row">
                                                <div class="col-mb-3 m-2">
                                                   <img class="m-2" src="../img/shop_logo/<?php echo $row['shop_profile_image']; ?>" id="voucherlogo">
                                                </div>
                                                <div class="col-mb-7 m-2">
                                                   <h6 class="card-title"><strong><?php echo $row['shop_name']; ?></strong></h6>
                                                   <h5 class="card-subtitle text-muted"><?php echo $row['discount_amount']; ?> <?php echo $row['voucher_type']; ?> off</h5>
                                                   <small>Validation:<?php echo $row['voucher_startdate']; ?> ~ <?php echo $row['voucher_expired']; ?></small><br>
                                                   <u>
                                                      <a type="" class="" data-toggle="modal" data-target="#termsv2Modal<?php echo $row['voucher_id']; ?>">
                                                      T&C applied.
                                                      </a>
                                                   </u>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="termsv2Modal<?php echo $row['voucher_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="termsModalTitle" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="termsModalLongTitle">Terms and Conditions.</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="d-flex justify-content-center">
                                                      <div class="card m-2" id="termsvouchercard">
                                                      <div class="container">
                                                            <img class="mt-3" src="../img/shop_logo/<?php echo $row['shop_profile_image']; ?>" id="voucherlogo">
                                                      </div>
                                                      <div class="card-body">
                                                            <h6 class="card-title"><strong><?php echo $row['shop_name']; ?></strong></h6>
                                                            <h5 class="card-subtitle text-muted"><?php echo $row['discount_amount']; ?> <?php echo $row['voucher_type']; ?> off</h5>
                                                            <small>Used : <?php echo $row['voucher_startdate']; ?> ~ <?php echo $row['voucher_expired']; ?></small><br>
                                                      </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="tnccontainer m-5 p-3">
                                                   <div class="container">
                                                      <strong>Product</strong>
                                                      <?php 

                                                       $voucher_id = $row['voucher_id'];

                                                       $sql_pn=
                                                       "SELECT
                                                       product.product_name,
                                                       voucher.voucher_id
                                                                           
                                                       FROM voucher
                                                       JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id
                                                       JOIN product ON productVoucher.product_id = product.product_id
                                                       JOIN shopProfile ON product.shop_id = shopProfile.shop_id
                                                       WHERE voucher.voucher_id = $voucher_id
                                                       ";
                           
                                                       $sm = $conn->prepare($sql_pn);
                                                       $sm->execute();
                                                       $res = $sm->get_result();

                                                             while ($r = $res->fetch_assoc()) {
                                                      ?>

                                                      <p><?php echo $r['product_name'];?></p>
                                                      <?php 

                                                   }?>
                                                   </div>
                                                   <div class="container">
                                                      <strong>More Details</strong>
                                                      <p> <?php echo $row['voucher_details']; ?> </p>
                                                   </div>
                                                   <div class="container">
                                                      <strong>Usage Period</strong>
                                                      <p><?php echo $row['voucher_startdate']; ?> ~ <?php echo $row['voucher_expired']; ?></p>
                                                   </div>
                                                </div>
                                          </div>
                                       </div>
                                    </div>
                            
                                    <?php 
                                       }else{
                                          ;
                                      }
                                    }?>
                              
                                 </div>
                              </div>
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
   width: 30rem;
   height: 10.5rem;
}
</style>
