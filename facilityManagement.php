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
   <h2 class="m-4">Facility Management</h2>
   <form method="post">
      <div class="container m-2">
         <h5 class="mt-2 mb-4">Basic Information</h5>
            <div class="form-row">
               <div class="form-group col-md-12">
                  <label for="">Select Campus</label>
                  <input type="text" aria-label="First name" class="form-control">
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-12">
                  <p class="p-title">Facility Name</p>
               </div>
               <div class="col-xl-10 col-lg-10 col-sm-12">
                  <div class="input-group mb-3">
                  <textarea class="form-control" name="title" maxlength="1000" required></textarea>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-12">
                  <p class="p-title">Facility Description</p>
               </div>
               <div class="col-xl-10 col-lg-10 col-sm-12">
                  <div class="input-group mb-3">
                  <textarea class="form-control" name="picDescription" maxlength="3000" required></textarea>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-12">
                  <p class="p-title">Facility Address</p>
               </div>
               <div class="col-xl-10 col-lg-10 col-sm-12">
                  <div class="input-group mb-3">
                  <textarea class="form-control" name="address" maxlength="1000" required></textarea>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="form-group col-md-12">
                  <p class="p-title">Stock</p>
               </div>
               <div class="col-xl-10 col-lg-10 col-sm-12">
                  <div class="input-group mb-2">
                     <input type="number"min="0" value="0" class="form-control" name="productStock" required>
                  </div>
               </div>
            </div>
            <div class="form-row">   
               <div class="form-group col-md-12">
                  <label for="">Facility Photo</label>  
                  <button type="button" class="btn btn-light btn-lg btn-block rounded p-5" data-toggle="modal" data-target="#selectproduct" style="border: dashed;" >+ Add Products</button>
               </div>               
            </div>
            <div class="d-sm-flex align-items-center mb-4" style="justify-content: end;">
            <button type="button"  onclick="submitForm()" class="btn btn-outline-primary"></i>Add Facility</button>
            <button type="submit" id="AddProduct" name="add" class="btn btn-outline-primary" hidden></i>Add Facility</button>
            </div>
         </div>    
      </div>
   </form>
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



<?php
   require __DIR__ . '/footer.php'
?>