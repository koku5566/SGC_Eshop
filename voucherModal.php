<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"> -->
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
         WHERE voucherRedemption.user_id = '$uid'
         GROUP BY voucher.voucher_id, shopProfile.shop_name, shopProfile.shop_profile_image, shopProfile.shop_id, voucherRedemption.voucher_id, voucherRedemption.user_id
         ";

         $stmt = $conn->prepare($sql_voucherR);
         $stmt->execute();
         $result = $stmt->get_result();

         $n = 0;
         while ($row = $result->fetch_assoc()) {

            $td = date('y-m-d');
            $expr = $row['voucher_expired'];
                                          
            $today = strtotime($td);
            $expired = strtotime($expr);

            if($row['voucher_display'] == 1 && $row['voucher_list'] == 1 && $row['voucher_limit'] > 0 && $expired > $today ){

         ?>

            <div class="form-check mt-2 mb-2 ml-4 mr-4">
               <input class="form-check-input" type="checkbox" name="user_group[]" value="<?php echo $row['shop_id']; ?>" data-voucher-id="<?php echo $row['voucher_id']; ?>" id="<?php echo $n++; ?>" onclick="getSelectItemThat(this.id)">
               <input type="hidden" id="<?php echo $row['voucher_id']; ?>_amount" value="<?php echo $row['discount_amount']; ?>">
               <input type="hidden" id="<?php echo $row['voucher_id']; ?>_type" value="<?php echo $row['voucher_type']; ?>">

               <label class="form-check-label" for="<?php echo $n; ?>">
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
            }
            
            }?>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="useVoucher()">Apply</button>
      </div>
    </div>
  </div>
</div>

<script>
   function useVoucher() {
      var values = new Array();
      $.each($("input[name='user_group[]']:checked"), function() {
      values.push($(this).val());
      var voucher_id = this.getAttribute("data-voucher-id");
      this.disabled = true;
      this.checked = false;
      for( var i=0; i<values.length;i++)
      {
         console.log(i +" is "+ values[i]);

         console.log("voucher Id: " + voucher_id);

         var amount = parseFloat($('#'+voucher_id+"_amount").val());
         var type = $('#'+voucher_id+"_type").val();
         
         console.log("Amount: " +  amount);
         console.log("type: " + type);

         //get tr element id
         var current_price = document.getElementById(values[i]).innerHTML;

         console.log("current price: " + current_price);

         var after_discount = 0;
         if (type == "cashback") {
            after_discount = current_price - amount;
         }
         else if(type == "%")
         {
            after_discount = (current_price * ((100 - amount) / 100));
         }

         document.getElementById(values[i]).innerText = (Math.round((after_discount + Number.EPSILON) * 100) / 100).toFixed(2);
         console.log("after discount: " + after_discount);
         calling();
         discountAmount();
      }
     
  // or you can do something to the actual checked checkboxes by working directly with  'this'
  // something like $(this).hide() (only something useful, probably) :P
   });

  
   
}

</script>