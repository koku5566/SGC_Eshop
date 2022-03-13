<?php
    require_once __DIR__ . '/header.php'
?>

<br>
<div class="container">
   <div class="row">
      <?php
      require __DIR__ . '/userprofilenav.php'
      ?>
      <br>
      <div class="col-xl-9">
         <div class="container d-flex justify-content-center" style="background-color: #ffffff">
            <div class="row row-cols-3 m-3">
               <div class="col-md-6 mt-2 mb-2">
                  <?php
                  require __DIR__ . '/voucher.php'
                  ?>
               </div>
               <div class="col-md-6 mt-2 mb-2">
                  <?php
                  require __DIR__ . '/voucher.php'
                  ?>
               </div>
               <div class="col-md-6 mt-2 mb-2">
                  <?php
                  require __DIR__ . '/voucher.php'
                  ?>
               </div>
               <div class="col-md-6 mt-2 mb-2">
                  <?php
                  require __DIR__ . '/voucher.php'
                  ?>
               </div>
               <div class="col-md-6 mt-2 mb-2">
                  <?php
                  require __DIR__ . '/voucher.php'
                  ?>
               </div>
               <div class="col-md-6 mt-2 mb-2">
                  <?php
                  require __DIR__ . '/voucher.php'
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