<?php
    require __DIR__ . '/header.php'
?>

<!-- Page Content -->
<div class="container mt-4" style="background-color: #FFFFFF; width:100%;">
   <h2 class="m-4">Create Voucher</h2>
   <form>
       <div class="container">
         <h5>Basic Information</h5>
         <div class="row mt-2">
            <label for="">Voucher Code</label>
            <div class="col-12">
               <input type="text" aria-label="First name" class="form-control" placeholder="Enter voucher code">
            </div>
         </div>
         <div class="row mt-2">
            <label for="">Voucher Claim Period</label>
            <div class="col-1">
               <h6 style="text-align: center">Start</h6>
            </div>
            <div class="col-5">
               <input type="date" aria-label="First name" class="form-control">
            </div>
            <div class="col-1">
               <h6 style="text-align: center">End</h6>
            </div>
            <div class="col-5">
               <input type="date" aria-label="First name" class="form-control">
            </div>
         </div>
         <div class="row mt-2">
            <label class="" for="">Voucer Discount Amount</label>
            <div class="input-group col-mb-12">
               <input type="text" aria-label="First name" class="form-control" for="inputGroupSelect02" placeholder="00.00">
               <div class="input-group-append">
               <select class="custom-select input-group-text" id="inputGroupSelect02">
                  <option selected>RM</option>
                  <option value="1">%</option>
               </select>
               </div>
            </div>
         </div>
         <div class="row mt-2">
            <label for="">Voucher Details</label><br>
            <div class="col-12">
               <textarea class="form-control" rows="10" placeholder="Creative Ideas, Creative DISCUSS.ION." required></textarea>
               <small class="text-muted m-2">Terms and Conditions may be applied here for futher agreement.</small>
            </div>
         </div>
         <br>
         <h5>Voucher Display and Applicable Products</h5>
         <div class="row">
            <label for="">Voucher Display Setting</label>
            <div class="col-12">
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
         <div class="row mt-2">
            <label for="">Applicable products</label>
            <div class="col-12">
               <div>
                  <button type="button" class="btn light btn-lg btn-block rounded" style="border: dashed;">+ Add Products</button>
               </div>
            </div>
         </div>    
       </div>
   </form>
</div>

<?php
    require __DIR__ . '/footer.php'
?>
