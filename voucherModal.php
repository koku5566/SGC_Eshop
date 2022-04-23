<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<link href="/css/voucher.css" rel="stylesheet" type="text/css">

<div class="container">
   <div class="row">
      <div class="col-md-12">
         <button type="button" class="btn btn-light btn-block" data-toggle="modal" data-target="#selectvoucher">
            <img class="m-2 selectvoucher" src="./img/voucher.png" style="float: left;">
            <p class="m-2" style="float: right;">Select or enter code</p>
         </button>
      </div>
   </div>
</div>

<!-- Select voucher Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="selectvoucher">
  <div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Select Voucher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Please enter plateform promo code." aria-describedby="applyvoucher">
            <div class="input-group-append">
               <button class="btn btn-warning" type="button" id="applyvoucher">Apply</button>
            </div>
         </div>
         <div class="scrolling-wrapper2 row">
         <?php

         $uid = $_SESSION['userid'];

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
         WHERE voucherRedemption.user_id = '$uid'
         GROUP BY voucher.voucher_id, shopProfile.shop_name, shopProfile.shop_profile_image, shopProfile.shop_id, voucherRedemption.voucher_id, voucherRedemption.user_id
         ";

         $stmt = $conn->prepare($sql_voucherR);
         $stmt->execute();
         $result = $stmt->get_result();

         while ($row = $result->fetch_assoc()) {

         ?>

            <div class="form-check mt-2 mb-2 ml-4 mr-4">
               <input class="form-check-input" type="checkbox" value="<?php echo $row['voucher_code']; ?>" id="defaultCheck1">
               <label class="form-check-label" for="defaultCheck1">
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
               </label>
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

                              <p><?php echo $r['product_name'];?>, </p>
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
            }?>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="myFunction()">Apply</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="termsModal2" tabindex="-1" role="dialog" aria-labelledby="termsModalTitle" aria-hidden="true">
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
                  <img class="m-4" src="../img/apple.jpg" id="voucherlogo">
               </div>
               <div class="card-body">
                  <h6 class="card-title"><strong>Apple Authorised Reseller</strong></h6>
                  <h5 class="card-subtitle text-muted">22% off</h5>
                  <small>Used : 01 FEB ~ 29 FEB</small><br>
               </div>
            </div>
         </div>
      </div>
      <div class="tnccontainer">
         <strong>Product</strong>
         <p>All products</p>
         <strong>More Details</strong>
         <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
         </p>
         <strong>Usage Period</strong>
         <p>12/07/2021 15:00:24 - 31/12/2021 23:59:59</p>
      </div>
    </div>
  </div>
</div>

<script>
   function myFunction() 
   {
   var x = document.getElementById("defaultCheck1").value;
   console.log(x);
   }
</script>