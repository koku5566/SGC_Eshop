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

$result = mysqli_query($conn, $sql);
?>

               



<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%">
  <h1 style="color: var(--bs-red);text-align: center;">Purchase History</h1>
      <button class="btn btn-primary" type="button" style="width: 89.5px;padding-left: 0px;margin-left: 0px;background: rgba(13,110,253,0);color: var(--bs-blue);border-style: none;border-color: var(--bs-body-bg);text-decoration: underline;">
        <i class="fa fa-long-arrow-left" style="padding-right: 9px;color: var(--bs-blue);background: rgba(255,255,255,0);"></i>
          Back
      </button>
    <div class="card">
        <div class="card-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-lg-4"><img src="segi kl.png" 
                     style="width: 400px;height: 50px;object-fit:contain;"/></div>
                    <div class="col-md-3 col-lg-1 "><i class="fa fa-home" style="width: 55.8625px;height: 68px;font-size: 50px;"></i></div>
                    <div class="col-md-3 col-lg-1 offset-lg-0"><img src="received.png" style="width:150px; height:50px; object-fir:contain;"/></div>
                    <div class="col-md-3 offset-lg-2"><p style="text-aligh:centre;">Date & Time:<br/> <span id="datetime"></span></p><br/></div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                 <?php
                   while ($row = mysqli_fetch_assoc($result)) {
                 ?>
                    <div class="col-md-3 col-lg-2" style="width:150px; height:150px;object-fit:contain"><img /><?php echo $row['product_cover_picture']?></div>
                    <div class="col-md-3 col-lg-2 offset-lg-1"><?php echo $row['product_name']?></div>
                    <div class="col-md-3 col-lg-1 offset-lg-1"><?php echo $row['product_qty']?></div>
                    <div class="col-md-3 col-lg-2 offset-lg-1"><?php echo $row['product_variation']?></div>
                    <div class="col">RM<?php echo $row['product_price']?></div>
                    <?php
                      }
                     ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-2"><button class="btn btn-primary" type="button" style="background: #1A2C42;">
                  <a href="viewPurchasingOrders.php"></a>Order Status</button></div>
                <div class="col-md-3 col-lg-2 offset-lg-1"><button class="btn btn-primary" type="button" style="background: #1A2C42;">Order Again</button></div>
                <div class="col-md-3 col-lg-2 offset-lg-1">
                    <p>Total</p>
                </div>
                <div class="col-md-3 offset-lg-1">
                    <p>Paragraph</p>
                </div>
             
            </div>
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


