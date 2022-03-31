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
    <i class="fa fa-long-arrow-left" style="padding-right: 9px;color: var(--bs-blue);background: rgba(255,255,255,0);">
    <a href="index.php">Back</a></i>
    </button>
    <div class="card">
    <div class="card-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">Shop__name</div>
                <div class="col-md-6 col-lg-4 offset-lg-2">Purchased__Date</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-1">Product__Image</div>
                <div class="col-md-3 col-lg-2">Product__Name</div>
                <div class="col-md-3 col-lg-1 offset-lg-1">Product_Qty</div>
                <div class="col-md-3 offset-lg-1">Product_Variant</div>
                <div class="col-lg-2 offset-lg-1">Product_Price</div>
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


