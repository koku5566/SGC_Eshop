<?php
    require_once __DIR__ . '/header.php'
?>

<link href="./css/voucher.css" rel="stylesheet" type="text/css">
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
            <!-- <div class="card" id="vouchercard2">
               <div class="card-body">
                  <div class="row">
                     <div class="col-mb-3 m-2">
                        <img class="m-2" src="../img/segilogo.png" id="voucherlogo">
                     </div>
                     <div class="col-mb-7 m-2">
                        <h6 class="card-title"><strong>SEGi Group of Colleges</strong></h6>
                        <h5 class="card-subtitle text-muted">RM1 off</h5>
                        <small>Used : 30 FEB 2022</small><br>
                        <u>
                           <a type="" class="" data-toggle="modal" data-target="#termsModal">
                           T&C applied.
                           </a>
                        </u>
                     </div>
                  </div>
               </div>
            </div> -->
            <?php
            require __DIR__ . '/voucher2.php'
            ?>
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
