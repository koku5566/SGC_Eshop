<?php
    require __DIR__ . '/header.php'
?>
<?php
$order_id = $_GET['order_id'];
$sqlod = "SELECT
myOrder.order_id,
myOrder.order_date,
orderDetails.quantity,
orderDetails.amount,
orderDetails.shop_id,
product.product_name,
product.product_price,
product.product_cover_picture,
shopProfile.shop_name,
shopProfile.shop_profile_image
FROM
myOrder
JOIN user ON myOrder.user_id = user.user_id
JOIN userAddress ON myOrder.user_id = userAddress.user_id
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN product ON orderDetails.product_id = product.product_id
JOIN shopProfile ON orderDetails.shop_id = shopProfile.shop_id
WHERE myOrder.order_id = '$order_id';";  
$stmtod = $conn->prepare($sqlod);
$stmtod->execute();
$resultod = $stmt_2->get_result();

?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="width:80%">
                    <h1 style="text-align:center; color: red ;">Order Status/ Order Details</h1>
                    <a href="getOrder.php" style="font-size:20px;">BACK</a>
                  
                    <section id="orders" class="order container my-5 py-3 ">
                        <div class="container mt-2">
                            <h2 class="font-weight-bold text-center">ORDER DETAILS</h2>
                            <hr class="mx-auto">
                        </div>
                    <?php while($rowod = $resultod ->fetch_assoc()){?>
                        <div class="card-header"><?php echo $rowod['order_id']?></div>

                        <?php }?>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
