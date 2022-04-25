<?php
    require __DIR__ . '/header.php';

    if(!isset($_SESSION)){
      session_start();
   }
   
   if(!isset($_SESSION['id']))
   {
         $_SESSION['id'] = "";
   }

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<!-- Select datatable CSS-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
<link href="/css/voucher.css" rel="stylesheet" type="text/css">

<div class="container">
   <div class="container m-2">
      <div class="form-row">
         <div class="form-group col-md-12">
            <table class="table" id="voucherReview">
               <thead>
                  <tr>
                     <th>Voucher Code</th>
                     <th>Voucher Type</th>
                     <th>Discount Amount</th>
                     <th>Voucher Start</th>
                     <th>Voucher Expired</th>
                     <th>Voucher Display</th>
                     <th>Voucher Limit</th>
                     <th>Status</th>
                     <th>List/Delist</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 

                     $shopId = $_SESSION['userid'];

                     $sql_myvoucher =
                     "SELECT
                        voucher.voucher_id,
                        voucher.voucher_code,
                        voucher.voucher_type,
                        voucher.discount_amount,
                        voucher.voucher_startdate,
                        voucher.voucher_expired,
                        voucher.voucher_display,
                        voucher.voucher_details,
                        voucher.voucher_limit,
                        voucher.voucher_list
                        -- shopProfile.shop_name,
                        -- shopProfile.shop_profile_image,
                        -- product.product_name,
                        -- product.product_id

                        FROM voucher
                        JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id	
                        JOIN product ON productVoucher.product_id = product.product_id		
                        JOIN shopProfile ON product.shop_id	= shopProfile.shop_id
                        WHERE shopProfile.shop_id = '$shopId'
                        GROUP BY voucher.voucher_id
                        "; 

                     $stmt = $conn->prepare($sql_myvoucher);
                     $stmt->execute();
                     $res = $stmt->get_result();

                     while ($r = $res->fetch_assoc()) {

                        $vid = $r['voucher_id'];
                        $vd = $r['voucher_display'];
                        $vl = $r['voucher_limit'];

                        $td = date('y-m-d');
                        $expr = $r['voucher_expired'];
                        $strt = $r['voucher_startdate'];
                                
                        $today = strtotime($td);
                        $expired = strtotime($expr);
                        $startdate = strtotime($strt);

                  ?>
                  <tr>
                     <td><?php echo $r['voucher_code']; ?></td>
                     <td><?php echo $r['voucher_type']; ?></td>
                     <td><?php echo $r['discount_amount']; ?></td>
                     <td><?php echo $r['voucher_startdate']; ?></td>
                     <td><?php echo $r['voucher_expired']; ?></td>
                     <td><?php echo $r['voucher_display']; ?></td>
                     <td><?php echo $r['voucher_limit']; ?></td>
                     <td>
                        <?php 
                        
                        if ($expired < $today){

                           echo("<span class=\"badge bg-secondary\">Expired</span>");

                         }elseif($r['voucher_limit'] == 0){

                           echo("<span class=\"badge bg-info\">Finish</span>");

                        }elseif($today >= $startdate){

                           echo("<span class=\"badge bg-success\">On-going</span>");

                        }elseif($today < $startdate){

                            echo("<span class=\"badge bg-warning\">Up-coming</span>");

                         }
                           // echo ("
                           //    <button type=\"submit\" name=\"edit\" class=\"btn btn-light\" data-bs-toggle=\"modal\" data-bs-target=\"#editVoucherModal$vid\"><i class=\"fa fa-edit\" aria-hidden=\"true\"></i></button>
                           // ");
                        ?>
                     </td>
                     <td>
                        <?php if ($r['voucher_list'] == 0){

                           $return = $_SERVER['PHP_SELF'];

                           echo ("

                           <form action=\"\" method=\"POST\" enctype=\"multipart/form-data\">
                              <input type=\"text\" name=\"vid\" value=\"$vid\">
                              <input type=\"text\" name=\"vd\" value=\"$vd\">
                              <input type=\"text\" name=\"ve\" value=\"$expr\">
                              <input type=\"text\" name=\"vl\" value=\"$vl\">
                              <button type=\"submit\" name=\"delist\" class=\"btn btn-secondary\">Delist</button>
                           </form>

                           ");

                        }elseif($r['voucher_list'] == 1 ){

                           $return = $_SERVER['PHP_SELF'];

                           echo ("

                           <form action=\"\" method=\"POST\" enctype=\"multipart/form-data\">
                              <input type=\"text\" name=\"vid\" value=\"$vid\">
                              <input type=\"text\" name=\"vd\" value=\"$vd\">
                              <input type=\"text\" name=\"ve\" value=\"$expr\">
                              <input type=\"text\" name=\"vl\" value=\"$vl\">
                              <button type=\"submit\" name=\"list\" class=\"btn btn-primary\">List</button>
                           </form>

                           ");

                        }
                        ?>
                     </td>
                  </tr>

                  <!--------------------------------------- Edit Voucher Modal -------------------------------------------->
                  <!-- <div class="modal fade" id="editVoucherModal<?php echo $r['voucher_id']?>" tabindex="-1" aria-labelledby="editVoucherModalLabel" aria-hidden="true">
                     <div class="modal-dialog" style="min-width: 88%; max-height:100%;">
                        <div class="modal-content">
                           <div class="modal-header">
                           <h5 class="modal-title" id="editVoucherModalLabel">Edit Voucher</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="container">
                                 <h5 class="mt-2 mb-4">Basic Information</h5>
                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                       <label for="">Voucher Code</label>
                                       <input type="text" name="voucherCode" aria-label="First name" class="form-control" placeholder="Enter voucher code" value="<?php echo $r['voucher_code']?>">
                                    </div>
                                 </div>
                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                       <label for="">Voucher Claim Period</label>
                                       <div class="row">
                                          <div class="col-md-6">
                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text" id="basic-addon1">Start</span>
                                                </div>
                                                <input type="date" name="voucherStartdate" aria-label="start date" class="form-control" value="<?php //echo $r['voucher_startdate']?>">
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text" id="basic-addon1">End</span>
                                                </div>
                                                <input type="date" name="voucherExpired" aria-label="end date" class="form-control" value="<?php //echo $r['voucher_expired']?>">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-row">
                                    <div class="form-group col-md-8">
                                       <label class="" for="">Voucer Discount Amount</label>
                                       <div class="input-group col-mb-6">
                                          <input type="text" name="discountAmount" aria-label="discountAmount" class="form-control" placeholder="00.00" value="<?php //echo $r['discount_amount']?>">
                                          <div class="input-group-append">
                                             <select name="voucherType" class="custom-select" value="<?php //echo $r['voucher_type']?>">
                                                <option value="<?php //echo $r['voucher_type']?>">Please choose</option>
                                                <option value="cashback">RM</option>
                                                <option value="%">%</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                       <label for="">Voucher Limit</label>
                                       <input type="text" name="voucherLimit" class="form-control" placeholder="Voucher Redeem/Use limit" value="<?php //echo $r['voucher_limit']?>">
                                    </div>
                                 </div>
                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <label for="">Voucher Details</label>
                                    <textarea name="voucherDetails" class="form-control" rows="10" placeholder="Please insert here" required><?php //echo $r['voucher_details']?></textarea>
                                    <small class="text-muted m-2">Terms and Conditions may be applied here for futher agreement.</small>
                                 </div>
                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                       <h5 class="mt-2 mb-4">Voucher Display and Applicable Products</h5>
                                    </div>
                                 </div>
                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                       <label for="">Voucher Display Setting</label>
                                       <div class="form-check" value="<?php //echo $r['voucher_display']?>">
                                          <input class="form-check-input" type="radio" name="voucherDisplay" id="exampleRadios1" value="1" checked>
                                          <label class="form-check-label" for="exampleRadios1">
                                             Display on all pages.
                                          </label>
                                       </div>
                                       <div class="form-check">
                                          <input class="form-check-input" type="radio" name="voucherDisplay" id="exampleRadios2" value="0">
                                          <label class="form-check-label" for="exampleRadios2">
                                             Do not display.
                                          </label>
                                          <small class="text-muted m-2">Voucher will not be displayed on any page but you may share the voucher code with the users.</small>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-row">
                                    <div class="form-group col-md-12">
                                       <table class="table">
                                          <thead>
                                             <tr>
                                                <th>Product Image</th>
                                                <th>Product Name</th>
                                                <th>Product ID</th>
                                                <th>Product SKU</th>
                                                <th>Price(RM)</th>
                                             </tr>
                                          </thead>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                           </div>
                        </div>
                     </div>
                  </div> -->
                  <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->

                  <?php 
                  }?>

               </tbody>

            </table>

            

         </div>
      </div>
   </div>
</div>



<?php

   if(isset($_POST['list'])){
         
      $voucher_id = $_POST['vid'];

      $sqll = "UPDATE voucher SET voucher_list = '0'
               WHERE voucher_id = '$voucher_id'";
                  
      if($conn->query($sqll))
      {
         echo '<script>alert("Your voucher has been delisted.")</script>';
      }
      else{
         echo '<script>alert("Your voucher failed to be delisted.")</script>';
      }
   }

   if(isset($_POST['delist'])){

       $vd = $_POST['vd'];
       $ve = $_POST['ve'];
       $vl = $_POST['vl'];

       if($vd == 0 || $vl == 0){

         echo '<script>alert("Your voucher cannot be list due to the Voucher Display, Voucher Status or Expired Date.")</script>';

       }else{

         $voucher_id2 = $_POST['vid'];

         $sqldl = "UPDATE voucher SET voucher_list = '1'
                  WHERE voucher_id = '$voucher_id2'";
                     
         if($conn->query($sqldl))
         {
            echo '<script>alert("Your voucher has been listed.")</script>';
         }
         else{
            echo '<script>alert("Your voucher failed to be listed.")</script>';
         }

       }

   }

   //if(isset($_POST['edit'])){

      // $voucher_id2 = $_POST['vid'];

      // $sqldl = "UPDATE voucher SET voucher_list = '1'
      //           WHERE voucher_id = '$voucher_id2'";
                  
      // if($conn->query($sqldl))
      // {
      //    echo '<script>alert("Your voucher has been listed.")</script>';
      // }
      // else{
      //    echo '<script>alert("Your voucher failed to be listed.")</script>';
      // }
   //}
   
?>

<script type ="module">
  $(document).ready(function() {
    $('#voucherReview').DataTable();
   } );
</script>


<!-- Datatable -->
<script charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<!-- Select datatable JS-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script type ="module" src="../bootstrap/js/bootstrap.min.js"></script>

<?php
    require __DIR__ . '/footer.php';
?>