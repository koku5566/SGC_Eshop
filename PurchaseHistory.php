<?php
    require __DIR__ . '/header.php'
?>


               

<?php
$sql = "SELECT 
product.product_name,
product.product_cover_picture,
product.product_qty,
product.product_variation,
product.product_price
FROM product
";
$result = mysqli_query($sql);


?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%">
  <h1 style="width: 315px;margin-left: 460px;color: #c71526;">Purchase History</h1>
  <div style="padding-left: 20px;padding-top: 40px;">
    <div>
        <button class="btn btn-primary" type="button" style="width: 89.5px;padding-left: 0px;margin-left: 0px;background: rgba(13,110,253,0);color: var(--bs-blue);border-style: none;border-color: var(--bs-body-bg);text-decoration: underline;">
          <i class="fa fa-long-arrow-left" style="padding-right: 9px;color: var(--bs-blue);background: rgba(255,255,255,0);"></i>
          Back
        </button>
        <br />
        <br />
        <br />
    </div>
  </div>
  <div>
    <div class="container" style="height: 550px;border-style: solid;">
      <!--this is the show part-->
      <div class="row">
        <div class="col" style="width: 500px;">
          <img src="img/segi kl.png" style="width:100px; margin-left:10px; object-fit:contain"  >
        </div>
        <div class="col">
          <p style="text-aligh:centre;">Date & Time:<br/> <span id="datetime"></span></p><br/>
        </div>
      </div>
      <br/>
       
      
    </div>
  </div>
             
</div>
  
  
   <!-- /.container-fluid -->


<?php
    require __DIR__ . '/footer.php'
?>

<style>
</style>

<script>
  var dt = new Date();
  document.getElementById("datetime").innerHTML = dt.toLocaleString();
</script> 


