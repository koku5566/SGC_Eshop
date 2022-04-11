<?php
    require __DIR__ . '/header.php'
?>
<?php
$sql_Odetail = "SELECT
myOrder.order_id,
myOrder.order_status,
product.product_name,
product.product_cover_picture,
product.product_price,
product.product_variation,
orderDetails.quantity,
orderDetails.price,
shopProfile.shop_name,
cancellation.cancellation_id

FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN product ON orderDetails.product_id = product.id
JOIN shopProfile ON product.shop_id = shopProfile.shop_id   
JOIN cancellation ON myOrder.cancellation_id = cancellation.cancellation_id
WHERE myOrder.order_id = ?
";

$stmt_Odetail = $conn->prepare($sql_Odetail);
$stmt_Odetail->execute();
$OrderDetails = $stmt_Odetail->get_result();


?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
                    <!--ORDER DETAILS-->
                        
                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
