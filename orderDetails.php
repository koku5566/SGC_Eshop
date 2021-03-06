<?php
    require __DIR__ . '/header.php'
?>
<?php
$order_id = $_GET['order_id'];


                         $sql4 = "SELECT
                         DISTINCT
                         myOrder.order_id,
                         product.product_name,
                         product.product_price ,
                         product.product_cover_picture,
                         shopProfile.shop_name,
                         variation.product_price ,
                         productTransaction.quantity
                         
                         FROM
                         myOrder
                         JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id
                         JOIN product ON productTransaction.product_id = product.product_id
                         JOIN shopProfile ON product.shop_id = shopProfile.shop_id
                         JOIN user on myOrder.userID = user.user_id 
                         JOIN cart ON myOrder.userID = cart.user_ID
                         JOIN variation ON product.product_id = variation.product_id
                         WHERE myOrder.order_id = $order_id";
                         
                         $result4 = $conn->query($sql4);
                         while($row4 = $result4->fetch_assoc()){
                             $amount =  $row4['product_price']*$row2['quantity'];
                             $totalamount += $amount;
                            // $totalPamt = $amount + $shippingfee;
                             if($row4['prodPrice'] == 0 ){
                                 $amount = $row4['variantProdPrice'] *$row4['quantity'];
                             } else{ 
                                 $amount = $row4['prodPrice'] *$row4['quantity'];
                              }
                            }
                              
                       

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
                    $shippingfee = 10;
                    $totalamount = 0;
                    $totalP = 0;
                    $sql2 = "SELECT
                    DISTINCT
                    myOrder.order_id,
                    product.product_name,
                    product.product_price ,
                    product.product_cover_picture,
                    shopProfile.shop_name,
                    myOrder.cancellation_status,
                    productTransaction.quantity
                    
                    FROM
                    myOrder
                    JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id
                    JOIN product ON productTransaction.product_id = product.product_id
                    JOIN shopProfile ON product.shop_id = shopProfile.shop_id
                    JOIN user on myOrder.userID = user.user_id 
                    JOIN cart ON myOrder.userID = cart.user_ID
                    
                    WHERE myOrder.order_id = $order_id";
                    
                    $result2 = $conn->query($sql2);
                    while($row2 = $result2->fetch_assoc()){
                        $amount =  $row2['product_price']*$row2['quantity'];
                        $totalamount += $amount;
                       // $totalPamt = $amount + $shippingfee;
                        /*if($row2['prodPrice'] == 0 ){
                            $amount = $row2['variantProdPrice'] *$row2['quantity'];
                        } else{ 
                            $amount = $row2['prodPrice'] *$row2['quantity'];
                         }*/

                ?>
                <div class="card">
                <div class="card-body">

                    <div class="row">
                        
                        <div class="col-1"><img src=/img/product/<?php echo $row2['product_cover_picture']?> style="object-fit:contain;width:100%;height:100%"></div>
                        <div class="col-5">
                            <?php echo $row2['product_name']; ?>
                        </div>
                        <div class="col-2">RM
                        <?php echo $row2['product_price']; ?>                    
                        </div>
                        <div class="col-2">X
                            <?php echo $row2['quantity']; ?>
                        </div>
                        <div class="col-2 red-text">RM
                        <?php  echo $amount?></td>
                        </div>
                       
                    </div>

                </div>
                <br>
                <div class="card-footer">
                    <div class="col-4" style="text-align:right; margin-left:60%">
                        <div class="row p-2">
                            <div class="col">Total:</div>
                            <div class="col"> 
                            <?php  echo $amount * $row2['quantity']?>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col">Discounts:</div>
                            <div class="col">-RM0.00</div>
                        </div>
                        <div class="row p-2">
                            <div class="col">Delivery Fees:</div>
                            <div class="col">
                                   <?php echo $shippingfee?>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col">
                                <h5>Order Total:</h5>
                                
                            </div>
                            <div class="col red-text">
                                <h5><strong>RM<?php  echo $amount * $row2['quantity'] + $shippingfee?></strong></h5>
                            </div>
                            
                        </div>
                        
                    </div>
                    <?php if($row2['order_status'] !='Completed' ||$row2['order_status'] =='Paid'){?>
                        <a class="btn btn-primary " style="margin-left:10px;"  href="cancellation.php?order_id=<?php echo $row2['order_id'];?>">Cancel Order</a>
                        <?php } else{ ?>
                            <a class= "btn btn-primary" href="getOrder.php">Back</a>
                            
                            <?php }?>
                    </div>
                    
                    <?php }?>
                </div>
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