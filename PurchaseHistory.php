<?php
    require __DIR__ . '/header.php'
?>

<?php
$sql_2 = "SELECT
myOrder.order_id,
myOrder.prod_qty,
product.product_name,
product.product_cover_picture,
product.product_price,
orderDetails.quantity,
orderDetails.price,
orderDetails.order_id,
orderDetails.order_id, 
shopProfile.shop_name

FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN product ON orderDetails.product_id = product.id
INNER JOIN shopProfile ON orderDetails.shop_id = shopProfile.shop_id";

$stmt_2 = $conn->prepare($sql_2);
$stmt_2->execute();
$result_2 = $stmt_2->get_result();



?>

               



<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%">
  <h1 style="color: var(--bs-red);text-align: center;">Purchase History</h1>
      <button class="btn btn-primary" type="button" style="width: 89.5px;padding-left: 0px;margin-left: 0px;background: rgba(13,110,253,0);color: var(--bs-blue);border-style: none;border-color: var(--bs-body-bg);text-decoration: underline;">
        <i class="fa fa-long-arrow-left" style="padding-right: 9px;color: var(--bs-blue);background: rgba(255,255,255,0);"></i>
          Back
      </button>
        <div class="tab-pane show active fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                                
                            <?php 
                            while ($row = $result_2->fetch_assoc()) {
                            ?>
                            <!--Each Order Item-->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col md-auto text-start"><span><strong><?php echo $row['shop_name']?></strong></span>
                                            </div>
                                            <div class="col md-auto text-end" style="text-align:right;"><span><strong>
                                                Order
                                                ID:
                                                <?php echo $row['order_id'] ?></strong></span></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-1 image-container">
                                                <img class="card-img-top img-thumbnail" style="object-fit:contain;width:60%;height:70%" src="/img/product/<?php echo $row['product_cover_picture']?>" alt="<?php echo $row['product_name']?>" />
                                            </div>
                                            <div class="col-md-3 col-lg-2 offset-lg-1"><?php echo $row['product_name']?></div>
                                            <div class="col-md-3 col-lg-1 offset-lg-1"><?php echo $row['quantity']?></div>
                                            <div class="col-md-3 col-lg-2 offset-lg-1">x<?php echo $row['prod_qty']?></div>
                                            <div class="col-md-3 col-lg-2 offset-lg-1" style="text-align:right;">RM<?php echo $row['price']?></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                    
                                        <button class="btn btn-primary" type="button" style="background: #1A2C42;">Order Status</button>
                                        <button class="btn btn-primary" type="button" style="background: #1A2C42;">Order Again</button>
                                        <a style="margin-left:50%;">Total</a>
                                    
                                    </div>
                                </div>
                                
                                <?php 
                                }?>                             
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


