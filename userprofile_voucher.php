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
      <div class="col-xl-9 container d-flex justify-content-center m-2" style="bacground-color: #ffffff">
         <div class="row">
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
<br>

<?php
    require __DIR__ . '/footer.php'
?>