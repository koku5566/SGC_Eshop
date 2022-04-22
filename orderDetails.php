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
    <div class="card-body" style="margin-top:10%">
        <div class="card">
               <h2>Tell us why do you want to cancel? &nbsp;&nbsp;</h2>
            <form method="post" action="orderDetails.php" style="font-size:25px;">
                <input type="radio" id="id_1" name="reason" value="Regrets"  checked>
                <label for="id_1" >Regrets</label><br>
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
    

    $sql = "UPDATE myorder SET reason_type = '$reason' , order_status='To respond' WHERE order_id = '$order_id'";
    $rs = $conn->query($sql);
    if($rs){
        
        echo 'Cancel Pending. Please wait for respond. <a href="getOrder.php">Click to return order page.</a>';
    }else{
        echo 'Cancel FAILED. <a href="getOrder.php">Click to return order page.</a>';
    }
    

}else{
?>

<div class="container-fluid" style="width:80%">
    <div class="card-body">
        <div class="order-list-panel">
            
            <div class="top-card card-header">
                <div class="row">
                    <div class="col-5">Product</div>
                    <div class="col-2">Unit Price</div>
                    <div class="col-1">Quantity</div>
                    <div class="col-3">Total Price</div>
                </div>
            </div>
        </div>
        <?php 
            while($row = $result ->fetch_assoc()){ 
            $order_id = $row['order_id'];
            $reason_type = $row['reason_type'];
            $order_status = $row['order_status'];
        ?>
            <!--Start of order item-->
            
            <div class="card">
                <?php
                    $sql2 = "SELECT * FROM orderDetails 
                    LEFT JOIN product ON orderDetails.product_id = product.id 
                    LEFT JOIN shopProfile ON orderDetails.shop_id = shopProfile.shop_id 
                    LEFT JOIN myorder ON orderDetails.order_id = myorder.order_id
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
                                src="https://as2.ftcdn.net/v2/jpg/02/23/22/49/1000_F_223224945_It1F8KPqNKubBWCOEYQXuYYdmSDIRkwZ.jpg"
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
                <button>Confirm Order ID <?php echo $order_id; ?></button>
                <button ><a href="orderDetails.php?cancelOrder=<?php echo $order_id; ?>">Cancel Order</a></button>              
            </div>    
        
        <br>
        <?php }?>
       
    </div> 
</div>
<?php } ?>


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
                <div class="card">
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
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-1"><img src=/img/product/<?php echo $row['product_cover_picture']?> style="object-fit:contain;width:100%;height:100%"></div>
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
                
            </div>
            <br>
            <div class="col-4" style="text-align:right; margin-left:60%">
                    <div class="row p-2">
                        <div class="col">Total:</div>
                        <div class="col"> RM<?php echo $row2['amount']?>.00</div>
                    </div>
                    <div class="row p-2">
                        <div class="col">Discounts:</div>
                        <div class="col">-RM0.00</div>
                    </div>
                    <div class="row p-2">
                        
                        <div class="col">Delivery Fees:</div>
                        <div class="col">
                            <?php echo $shippingfee?>0
                        </div>
                    </div>
                    <div class="row p-2">
                        
                        <div class="col">
                            <h5>Order Total:</h5>
                           
                        </div>
                        <div class="col red-text">
                            <h5><strong>RM<?php echo $row2['amount']?>.00</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                
                <button ><a href="getOrder.php?cancelOrder=<?php echo $order_id; ?>">Cancel Order </a></button>
                    
                    <a class="btn btn-primary"style="margin-left:10px;" href="getOrder.php?confirm&id=<?php echo $row['order_id'];?>" onclick="return complete_click();">Confirmed Order</a>
                   
                    <span class="col-6" style="margin-left:40%;">Order Status: <?php echo $row2['order_status']?></span>
                </div>
                <?php } ?>
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
return confirm("Are you sure to cancel order?");
}
function complete_click()
{
    return confirm("Are you sure to complete the orders?");
}

</script>