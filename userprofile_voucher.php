<?php
    require_once __DIR__ . '/header.php'
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

<br>
<div class="container">
   <div class="row">
      <?php
      require __DIR__ . '/userprofilenav.php'
      ?>
      <br>
      <div class="col-xl-9">
         <div class="container p-4" style="background-color: #ffffff">
            <div class="row row-cols-2">
               <div class="col-6">
                  <?php
                  require __DIR__ . '/voucher2.php'
                  ?>
               </div>
            </div>
         </div>
         <br>
         <div class="container">
            <nav aria-label="Page navigation example">
               <ul class="pagination justify-content-end">
               <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
               </li>
               <li class="page-item"><a class="page-link" href="#">1</a></li>
               <li class="page-item"><a class="page-link" href="#">2</a></li>
               <li class="page-item"><a class="page-link" href="#">3</a></li>
               <li class="page-item">
                  <a class="page-link" href="#">Next</a>
               </li>
               </ul>
            </nav>
            <br>
         </div>
      </div>
   </div>
</div>


<?php
    require __DIR__ . '/footer.php'
?>

<style>
   #voucherlogo{
   height: 100px !important;
   width: 100px !important;
}

#vouchercard{
   width: 11.5rem;
   height: 22rem;
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
   width: 25rem;
   height: 10.5rem;
}

/* -------------------- Category Scrollbar----------------------- */

/* width */
::-webkit-scrollbar {
   width: 5px;
   height: 5px;
 }

 .scrolling-wrapper{
	overflow-x: auto;
}

 .scrolling-wrapper2{
	overflow-y: auto;
   max-height: 580px;
}
</style>
