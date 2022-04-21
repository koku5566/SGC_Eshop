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
                     <th>Voucher ID</th>
                     <th>Voucher Code</th>
                     <th>Voucher Type</th>
                     <th>Voucher Start</th>
                     <th>Voucher Expired</th>
                     <th>Voucher Details</th>
                     <th>Voucher Limit</th>
                     <th>Status</th>
                     <th>List/Delist</th>
                  </tr>
               </thead>
               <?php 

                      $shopId = $_SESSION['uid'];

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

                         FROM voucher
                        --  JOIN productVoucher ON voucher.voucher_id = productVoucher.voucher_id	
                        --  JOIN product ON productVoucher.product_id = product.product_id	
                        --  JOIN user ON product.user_id = user.user_id
                        --  JOIN shop ON user.user_id = shop.shop_id
                         "; 

                      $stmt = $conn->prepare($sql_voucher);
                      $stmt->execute();
                      $result = $stmt->get_result();

                      while ($row = $res->fetch_assoc()) {

               ?>
               <tbody>
                  <tr>
                     <td><?php echo $row['voucher_id']; ?></td>
                     <td><?php echo $row['voucher_code']; ?></td>
                     <td><?php echo $row['voucher_type']; ?></td>
                     <td><?php echo $row['voucher_startdate']; ?></td>
                     <td><?php echo $row['voucher_expired']; ?></td>
                     <td><?php echo $row['voucher_details']; ?></td>
                     <td><?php echo $row['voucher_limit']; ?></td>
                     <td><?php echo $row['voucher_status']; ?></td>
                     <td><?php echo $row['voucher_list']; ?></td>

                  </tr>
               </tbody>
               <?php 
                }?>
            </table>
         </div>
      </div>
   </div>
</div>

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