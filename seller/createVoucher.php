<?php
   require __DIR__ . '/header.php'
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


<!-- Page Content -->
<div class="container p-2" style="background-color: #FFFFFF; width:80%;">
   <h2 class="m-4">Create Voucher</h2>
   <form method="post">
      <div class="container m-2">
         <h5 class="mt-2 mb-4">Basic Information</h5>
            <div class="form-row">
               <div class="form-group col-md-12">
                  <label for="">Voucher Code</label>
                  <input type="text" aria-label="First name" class="form-control" placeholder="Enter voucher code">
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
                           <input type="date" aria-label="start date" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">End</span>
                           </div>
                           <input type="date" aria-label="end date" class="form-control">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-8">
                  <label class="" for="">Voucer Discount Amount</label>
                  <div class="input-group col-mb-6">
                     <input type="text" aria-label="discountAmount" class="form-control" for="inputGroupSelect02" placeholder="00.00">
                     <div class="input-group-append">
                        <select class="custom-select" id="inputGroupSelect02">
                           <option value="1">RM</option>
                           <option value="1">%</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-4">
                  <label for="">Voucher Limit</label>
                  <input type="text" class="form-control" placeholder="Voucher Redeem/Use limit">
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-12">
               <label for="">Voucher Details</label>
               <textarea class="form-control" rows="10" placeholder="Please insert here" required></textarea>
               <small class="text-muted m-2">Terms and Conditions may be applied here for futher agreement.</small>
            </div>
         </div>
         <div class="container">
            <h5 class="mt-2 mb-4">Voucher Display and Applicable Products</h5>
            <div class="form-row">
               <div class="form-group col-md-12">
                  <label for="">Voucher Display Setting</label>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                     <label class="form-check-label" for="exampleRadios1">
                        Display on all pages.
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                     <label class="form-check-label" for="exampleRadios2">
                        Do not display.
                     </label>
                     <small class="text-muted m-2">Voucher will not be displayed on any page but you may share the voucher code with the users.</small>
                  </div>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-12">
                  <label for="">Applicable products</label>
                  <button type="button" class="btn btn-light btn-lg btn-block rounded p-5" data-toggle="modal" data-target="#selectproduct" style="border: dashed;" >+ Add Products</button>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group justify-content-right col-md-12">
               <button type="button" class="btn btn-warning btn-lg" name="savevoucher">SAVE</button>
               </div>
            </div>
         </div>    
      </div>
   </form>
</div>

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
                            <th>Product SKU</th>
                            <th>Variation</th>
                            <th>Price</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <td></td>
                        <td>Product Image</td>
                        <td>Product Name</td>
                        <td>Product SKU</td>
                        <td>Variation</td>
                        <td>Price</td>
                        <td>Delete</td>
                    </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Datatable -->
<script charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<!-- Select datatable JS-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script type ="module" src="../bootstrap/js/bootstrap.min.js"></script>
<script type ="module" src="/js/createVoucher.js"></script>

<?php
   require __DIR__ . '/footer.php'
?>