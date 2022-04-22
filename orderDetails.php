<?php
    require __DIR__ . '/header.php'
?>
<?php
$order_id = $_GET['order_id'];

?>
<?php
if(@$_GET){
?>

<div class="container-fluid" style="width:80%">
    <div class="card-body">
        <div class="card">
            <h2>Tell us why do you want to cancel?</h2>
            <form method="post" action="getOrder.php">
                <input type="radio" id="id_1" name="reason" value="Regrets" checked>
                <label for="id_1">Regrets</label><br>
                <input type="radio" id="id_2" name="reason" value="Change Of Mind">
                <label for="id_2">Change of Mind</label><br>
                <input type="radio" id="id_3" name="reason" value="Change Color">
                <label for="id_3">Change Color</label><br>
                <input type="radio" id="id_4" name="reason" value="Others" checked>
                <label for="id_1">Others</label><br>
                <input type="hidden" id="order_id" name="order_id" value="<?php echo $_GET['cancelOrder']; ?>">
                <input type="submit" value="Confirm">
            </form>
            <div><button><a href="getOrder.php">Back</a></button></div>
        </div>
    </div>
</div>

<?php
}elseif(@$_POST){

    $reason = $_POST['reason'];
    $order_id = $_POST['order_id'];

    $sql = "UPDATE myorder SET reason_type = '$reason' WHERE order_id = '$order_id'";
    $rs = $conn->query($sql);

    if($rs){
        echo 'Cancel SUCCESS. <a href="getOrder.php">Click to return order page.</a>';
    }else{
        echo 'Cancel FAILED. <a href="getOrder.php">Click to return order page.</a>';
    }

}else{
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
                            <div class="col-1">Quantity</div>
                            <div class="col-3">Total Price</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                <?php
                    $sql2 = "SELECT * FROM orderDetails 
                     LEFT JOIN product ON orderDetails.product_id = product.id 
                     LEFT JOIN shopProfile ON orderDetails.shop_id = shopProfile.shop_id 
                     LEFT JOIN myOrder ON orderDetails.order_id = myOrder.order_id
                     WHERE orderDetails.order_id = $order_id";
                    if(@$user_id){
                        $sql2 .= " AND myorder.user_id = '$user_id'";
                    }
                    $result2 = $conn->query($sql2);
                    while($row2 = $result2->fetch_assoc()){
                ?>
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-1"><img class="card-img-top img-thumbnail"
                                style="object-fit:contain;width:100%;height:100%"
                                src="img/product/<?php echo $row2['product_cover_picture'] ?>"
                                alt="<?php echo $row2['product_name']; ?>" /></div>
                        <div class="col-4">
                            <?php echo $row2['product_name']; ?>
                        </div>
                        <div class="col-2">RM
                            <?php echo $row2['product_price']; ?>.00
                        </div>
                        <div class="col-1">X
                            <?php echo $row2['quantity']; ?>
                        </div>
                        <div class="col-3 red-text">RM
                            <?php echo $row2['price']; ?>.00
                        </div>
                        
                    </div>
                </div>
                <?php } ?>
            </div>
                <div class="card-footer">
                <?php if($row['order_status'] =='Paid'){?>
                    <a class="btn btn-primary " style="margin-left:10px;"  href="purchaseShippingDetails.php?order_id=<?php echo $row['order_id'];?>">Cancel Order</a>
                    <?php } else{ ?>
                    <a class="btn btn-primary"style="margin-left:10px;" href="purchaseShippingDetails.php?order_id=<?php echo $row['order_id'];?>">Confirmed Order</a>
                    <?php }?>
                </div>
               
            </div>
          


        </section>
    </div>
    <?php }?>
                   
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
