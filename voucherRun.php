<?php

   $sql_voucher =
    "SELECT 
     voucher.voucher_id,
     voucher.voucher_code,
     voucher.voucher_startdate,
     voucher.voucher_expired,
     voucher.voucher_display,
     voucher.voucher_type,
     voucher.voucher_limit,
     voucher.voucher_details,
     voucher.discount_amount,
     shopProfile.shop_name,
     shopProfile.shop_profile_image,
     product.product_name

     FROM voucher
     JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id	
     JOIN product ON productVoucher.product_id = product.product_id	
     JOIN user ON product.user_id = user.user_id
     JOIN shop ON user.user_id = shop.shop_id
     GROUP BY voucher.voucher_id"; 

   $stmt = $conn->prepare($sql_voucher);
   $stmt->execute();
   $result = $stmt->get_result();

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<link href="/css/voucher.css" rel="stylesheet" type="text/css">


      <div class="container">
         <div class="scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4 pt-2">
            <?php  while ($row = $result->fetch_assoc()) {

               $td = date('y-m-d');
               $expr = $row['voucher_expired'];

               $today = strtotime($td);
               $expired = strtotime($expr);

               if($row['voucher_display'] > 0  && $row['voucher_limit'] > 0 && $expired > $today){
            
            ?>

            <div class="col-md-2 m-2">
               <div class="card" id="vouchercard">
                  <div class="container">
                     <img class="m-4" src="../img/<?php echo $row['shop_profile_image']; ?>" id="voucherlogo">
                  </div>
                  <div class="card-body">
                     <h6 class="card-title"><strong><?php echo $row['shop_name']; ?></strong></h6>
                     <h5 class="card-subtitle text-muted"><?php echo $row['discount_amount']; ?><?php echo $row['voucher_type']; ?> off</h5>
                     <small>Used : <?php echo $row['voucher_startdate']; ?> ~ <?php echo $row['voucher_expired']; ?></small><br>
                     <u>
                        <a type="" class="" data-toggle="modal" data-target="#termsModal<?php echo $row['voucher_id']; ?>">
                        T&C applied.
                        </a>
                     </u>
                  </div>
                  <div class="card-footer">
                     <button type="button" class="btn btn-warning btn-sm" style="float: right" data-toggle="modal" data-target="#alert">CLAIM</button>
                  </div>
               </div>
            </div>

         <!-- Modal -->

         <div class="modal fade" id="termsModal<?php echo $row['voucher_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="termsModalTitle" aria-hidden="true">
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
                              <img class="m-4" src="../img/<?php echo $row['shop_profile_image']; ?>" id="voucherlogo">
                           </div>
                           <div class="card-body">
                              <h6 class="card-title"><strong><?php echo $row['shop_name']; ?></strong></h6>
                              <h5 class="card-subtitle text-muted"><?php echo $row['discount_amount']; ?><?php echo $row['voucher_type']; ?> off</h5>
                              <small>Used : <?php echo $row['voucher_startdate']; ?> ~ <?php echo $row['voucher_expired']; ?></small><br>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tnccontainer">
                     <div class="container">
                        <strong>Product</strong>
                        <p><?php echo $row['product_name']; ?></p>
                     </div>
                     <div class="container">
                        <strong>More Details</strong>
                        <p> <?php echo $row['voucher_details']; ?> </p>
                     </div>
                     <div class="container"><strong>Usage Period</strong></div>
                     <div class="container"><p><?php echo $row['voucher_startdate']; ?> ~ <?php echo $row['voucher_expired']; ?></p></div>
                  </div>
               </div>
            </div>
         </div>
            
            <?php }else{
               }
          }?>

            
         </div>
      </div>