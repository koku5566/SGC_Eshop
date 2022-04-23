<?php
    require __DIR__ . '/header.php'
?>
<?php
    $orderid = $_GET['order_id'];
    $cancelsql ="SELECT
    myOrder.order_id,
    myOrder.order_status,
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
    JOIN user ON myOrder.userID = user.user_id
    JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
    JOIN product ON orderDetails.product_id = product.product_id
    JOIN shopProfile ON orderDetails.shop_id = shopProfile.shop_id
    WHERE myOrder.order_id = '$orderid';";
    $stmt = $conn->prepare($cancelsql);
    $stmt->execute();
    $resultc = $stmt->get_result();
    while ($rowc = $resultc->fetch_assoc()) {
        $orderid = $rowc['order_id'];
        $orderdate = $rowc['order_date'];
        $qty = $rowc['quantity'];
        $amt = $rowc['amount'];
        $productname = $rowc['product_name'];
        $productprice = $rowc['product_price'];
        $productcover = $rowc['product_cover_picture'];
        $shopname = $rowc['shop_name'];
        $shopprofile = $rowc['shop_profile_image'];
    }
?>
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
  <!---CANCEL ORDER----->
  <h1 style="text-align:center; color: red ;">CANCELLATION</h1>
  <a href="index.php" style="font-size:20px;">BACK</a>
  <section id="orders" class="order container my-5 py-3 ">
    <div class="container mt-2">
      <h2 class="font-weight-bold text-center">ARE YOU SURE YOU WANT TO CANCEL YOUR ORDER?</h2>
      <hr class="mx-auto">
    </div>
  </section>    
</div>

<!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
