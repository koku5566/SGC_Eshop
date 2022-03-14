<?php
    require_once __DIR__ . '/header.php'
?>

<link href="/css/voucher.css" rel="stylesheet" type="text/css">

<br>
<div class="container">
   <div class="row">
      <?php
      require __DIR__ . '/userprofilenav.php'
      ?>
      <br>
      <div class="col-xl-9">
         <div class="container" style="background-color: #ffffff">
            <div class="card" id="vouchercard2">
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