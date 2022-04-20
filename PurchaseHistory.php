<?php
    require __DIR__ . '/header.php'
?>

<?php 


$sql_2 = "SELECT
myOrder.order_id,
product.product_name,
product.product_cover_picture,
product.product_price,
product.product_variation,
orderDetails.quantity,
orderDetails.amount,
shopProfile.shop_name

FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN product ON orderDetails.product_id = product.id
JOIN shopProfile ON product.shop_id = shopProfile.shop_id";
$stmt_2 = $conn->prepare($sql_2);
$stmt_2->execute();
$result_2 = $stmt_2->get_result();


?>

               



<!-- Begin Page Content -->
<div class="container-fluid" id="mainContainer">

</div>

   
   <!-- /.container-fluid -->


<?php
    require __DIR__ . '/footer.php'
?>




