<?php
    require __DIR__ . '/header.php'
?>
<?php
$order_id = $_GET['order_id'];


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
            
            <div class="card">
                <div class="card-header">
                    <div class="order-list-panel">
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-5">Product</div>
                            <div class="col-2">Unit Price</div>
                            <div class="col-2">Quantity</div>
                            <div class="col-2">Total Price</div>
                        </div>
                    </div>
                </div>
                
                <?php
                    $shippingfee = 8.6;
                    $sql2 = "SELECT * FROM myOrder 
                    JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
                    JOIN product ON orderDetails.product_id = product.product_id
                    JOIN shopProfile ON orderDetails.shop_id = shopProfile.shop_id
                    WHERE myOrder.order_id = $order_id";
                    
                    $result2 = $conn->query($sql2);
                    while($row2 = $result2->fetch_assoc()){
                ?>
                <div class="card">
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-1"><img src=/img/product/<?php echo $row2['product_cover_picture']?> style="object-fit:contain;width:100%;height:100%"></div>
                        <div class="col-5">
                            <?php echo $row2['product_name']; ?>
                        </div>
                        <div class="col-2">RM
                            <?php echo $row2['product_price']; ?>.00
                        </div>
                        <div class="col-2">X
                            <?php echo $row2['quantity']; ?>
                        </div>
                        <div class="col-2 red-text">RM
                            <?php echo $row2['amount']; ?>.00
                        </div>
                        
                    </div>
                </div>
                <br>
               <?php }?>
                <br>
            </div>
        </section>
    </div>
<!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
<script type="text/javascript">
function confirm_click()
{
return confirm("Are you sure you want to complete the order?");
}


</script>