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
            <div class="row m-1">
               <div class="col-md-6">
                  <?php
                  require __DIR__ . '/voucher.php'
                  ?>
               </div>
               <div class="col-md-6">
                  <?php
                  require __DIR__ . '/voucher.php'
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<br>

<?php
    require __DIR__ . '/footer.php'
?>