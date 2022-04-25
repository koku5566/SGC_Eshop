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
 
<!-- Page Content -->
<div class="container p-2" style="background-color: #FFFFFF; width:80%;">
   <h2 class="m-4">Create Voucher</h2>
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
      <div class="container m-2">
         <h5 class="mt-2 mb-4">Basic Information</h5>
            <div class="form-row">
               <div class="form-group col-md-12">
                  <label for="">Voucher Code</label>
                  <input type="text" name="voucherCode" aria-label="First name" class="form-control" placeholder="Enter voucher code">
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
                           <input type="date" name="voucherStartdate" aria-label="start date" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">End</span>
                           </div>
                           <input type="date" name="voucherExpired" aria-label="end date" class="form-control">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-8">
                  <label class="" for="">Voucer Discount Amount</label>
                  <div class="input-group col-mb-6">
                     <input type="text" name="discountAmount" aria-label="discountAmount" class="form-control" placeholder="00.00">
                     <div class="input-group-append">
                        <select name="voucherType" class="custom-select">
                           <option value="">Please choose</option>
                           <option value="cashback">RM</option>
                           <option value="%">%</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-4">
                  <label for="">Voucher Limit</label>
                  <input type="text" name="voucherLimit" class="form-control" placeholder="Voucher Redeem/Use limit">
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-12">
               <label for="">Voucher Details</label>
               <textarea name="voucherDetails" class="form-control" rows="10" placeholder="Please insert here" required></textarea>
               <small class="text-muted m-2">Terms and Conditions may be applied here for futher agreement.</small>
            </div>
         </div>
         <div class="container">
            <h5 class="mt-2 mb-4">Voucher Display and Applicable Products</h5>
            <div class="form-row">
               <div class="form-group col-md-12">
                  <label for="">Voucher Display Setting</label>
                  <div class="form-check">
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
                  <table class="table" id="createvouchertable">
                     <thead>
                        <tr>
                           <th>Product Image</th>
                           <th>Product Name</th>
                           <th>Product ID</th> <!-- data-visible="false" -->
                           <th>Product SKU</th>
                           <th>Price (RM)</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        
                     </tbody>
                  </table>
               </div>
               <div class="form-group col-md-12">
                  <label for="">Applicable products</label>
                  <button type="button" class="btn btn-light btn-lg btn-block rounded p-1" data-toggle="modal" data-target="#selectproduct" style="border: dashed;" >+ Add Products</button>
               </div>
            </div>
            <div class="form-row" id="productraw">

            </div>
            <div class="form-row">
               <div class="float-right">
                  <button type="submit" name="submit" class="btn btn-warning" style="float: right">SAVE</button>
               </div>
            </div>
         </div>    
      </div>
   </form>
</div>

<?php 
   if($_SERVER['REQUEST_METHOD'] == 'POST'|| isset($_POST['submit'])){

      $voucherCode = $_POST['voucherCode'];
      $voucherStartdate = $_POST['voucherStartdate'];
      $voucherExpired = $_POST['voucherExpired'];
      $discountAmount = $_POST['discountAmount'];
      $voucherLimit = $_POST['voucherLimit'];
      $voucherType = $_POST['voucherType'];
      $voucherDetails = $_POST['voucherDetails'];
      $voucherDisplay = $_POST['voucherDisplay'];
      $vlist = "1";
      $date = date('Y-m-d H:i:s');

      
      $sqlv = "INSERT INTO voucher (voucher_code, voucher_startdate, voucher_expired, discount_amount, voucher_limit, voucher_details, voucher_display, voucher_type, created_at, voucher_list)
               VALUES ('$voucherCode', '$voucherStartdate', '$voucherExpired', '$discountAmount', '$voucherLimit', '$voucherDetails', '$voucherDisplay', '$voucherType', '$date', '$vlist');";
      
      mysqli_query($conn, $sqlv);

      $product = $_POST['productlist'];
      $v = mysqli_insert_id($conn);//specific table

      for($i = 0; $i < count($product); $i++){

         $sqlpv = "INSERT INTO productVoucher (product_id, voucher_id)
                  VALUES ('".$product[$i]."', '$v');"; //get prod first array

         $res = mysqli_query($conn, $sqlpv);

         if($res)
            {
               echo '<script>alert("Voucher added succesfully.")</script>';
            }
            else
            {
                echo '<script>alert("Voucher added failed.")</script>';
            }
      }

    }
    else {
       echo "error";
    }
   
?>

<!-- Add Product Modal -->
<div class="modal fade" id="selectproduct" tabindex="-1" role="dialog" aria-labelledby="selectproductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="selectproductModalLabel">Select Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="form-row">
            <div class="form-group col-md-12">
                <table class="table" id="vouchertable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product ID</th> <!-- data-visible="false" -->
                            <th>Product SKU</th>
                            <th>Price (RM)</th>
                        </tr>
                    </thead>
                    
                    <tbody> 
                     <?php 
                        $shopId = $_SESSION['userid'];

                        $sqlp = 
                        "SELECT 
                         shopProfile.shop_name,
                         shopProfile.shop_profile_image,
                         product.product_name,
                         product.product_cover_picture,
                         product.product_id,
                         product.product_sku,
                         product.product_stock,
                         product.product_price
                    
                         FROM shopProfile
                         INNER JOIN product ON shopProfile.shop_id = product.shop_id
                         WHERE product.shop_id = '$shopId'";
                    
                    
                       $stmt = $conn->prepare($sqlp);
                       $stmt->execute();
                       $res = $stmt->get_result();
                       while ($row = $res->fetch_assoc()) {
                          if($row['product_stock'] > 0)
                          {

                         
                     ?>
                     <tr>
                        <td></td>
                        <td id="voucherlogo"><img src="../img/product/<?php echo $row['product_cover_picture']; ?>"></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['product_sku']; ?></td>
                        <td><?php echo $row['product_price']; ?></td>
                     </tr>
                     <?php 
                        }
                     }?>
                    </tbody>
               </table>
            </div>
         </div>
         <!-- <input type="checkbox" class="selectAll" name="selectAll" value="all" id="selectAll">   Select All -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="select">Select</button>
      </div>
    </div>
  </div>
</div>

<script type ="module">
   var createvouchertable = $('#createvouchertable').DataTable( {
   retrieve: true,
   responsive: true,
   scrollCollapse: true,
   scrollY: '350px',
   ordering: true,
   searching: false,
   paging: false,
   columnDefs: [{
      targets: -1,
      data: null,
      defaultContent: '<button class="btn btn-light btn-sm" type="button" data-toggle="tooltip"><i class="fa fa-trash"></i></button>'
   }],
   select: {
   style:    'multi', //'multi' - select multiple checkbox
   selector: 'td:first-child'
   },
   order: [[ 1, 'asc' ]]
   } );
   var vouchertable = $('#vouchertable').DataTable( {
   retrieve: true,
   responsive: true,
   scrollCollapse: true,
   ordering: true,
   searching: true,
   paging: true,
   columnDefs: [ {
   targets:   0,
   className: 'select-checkbox',
   }],
   lengthMenu:[
   [4,-1],
   [4,"All"]
   ],
   select: {
   style:    'multi', //'multi' - select multiple checkbox
   selector: 'td:first-child'
   },
   order: [[ 1, 'asc' ]]
   } );
   //-----------------------Delete Row-----------------------------//
   
   $('#createvouchertable tbody').on( 'click', 'button', function () {
   var row = createvouchertable.row($(this).parents('tr'));
   row.remove().draw(false);
   
   });
   //----------------------------Multiselect Function--------------------------------//
   $('#vouchertable tbody').on( 'click', 'tr', function () {
    
     $(this).toggleClass('selected');
   });
      // $("#selectAll").on( "click", function(e) {
      //    if ($(this).is( ":checked" )) {
      //       vouchertable.rows({
      //          page:'current'
      //       } ).select(); 
      //    }else {
      //       vouchertable.rows({
      //          page:'current'
      //       } ).deselect(); 
      //    }
      // });
      $('#select').click( function () {
         var testdata = [];
         testdata = vouchertable.rows('.selected').data();
         for(var i = 0; i<testdata.length; i++)
         {
            const rowInsert = [];
            
            for(var j = 0; j<testdata[i].length; j++)
            {
               rowInsert.push(testdata[i][j]);
            }
            let pid = $('#productList').val();
            let productid = $('<input type="text" name="productlist[]" class="form-control" hidden>').val(rowInsert[3]).append(pid);
            console.log(rowInsert[3]);
            $('#productraw').append(productid);
            createvouchertable.row.add([
            rowInsert[1],
            rowInsert[2],
            rowInsert[3],
            rowInsert[4],
            rowInsert[5],
            "",
      
            ] ).draw( false );
         }
            
      });

     $('#select').on( 'click',function () {
      $("#selectproduct").modal("hide"); 
     });

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