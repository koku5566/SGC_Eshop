<?php
    require __DIR__ . '/header.php'
?>
<?php

   


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
                                          
                                            <div class="col-1">No.</div>
                                            <div class="col-5">Product(s)</div>
                                            <div class="col-2">Unit Price</div>
                                            <div class="col-1">Quantity</div>
                                            <div class="col-3">Total Amount</div>
                                        </div>
                                    </div>
                                </div>
                                  <?php
                                        $count=1;
                                        while($row = $order_details->fetch_assoc()){
                                        ?>
                                        <div class="order-list-panel">
                                            <div class="row">
                                                <div class="col-1"><?php echo $count++; ?>.</div>
                                                <div class="col-5"><img src="/img/product/<?php echo $row['product_cover_picture']?>">&nbsp;&nbsp;<?php echo $row["product_name"]; ?></div>
                                                <div class="col-2"><?php echo $row["product_price"]; ?></div>
                                                <div class="col-1"><?php echo $row["quantity"]; ?></div>
                                                <div class="col-3"><?php echo $row["price"]; ?></div>
                                            </div>
                                        </div>
                                                
                                                
                                            
                                        <hr>
                                        <?php } ?>

                                        <br>
                                        <a href="orderDetails.php?cancel&id=<?php echo $order_id?>" onclick="return confirm_click();"><button type="button" class="btn btn-primary">Cancel Order</button></a>
                                        <a href="orderDetails.php?confirm&id=<?php echo $order_id?>" onclick="return confirm_click();"><button type="button" class="btn btn-primary">Confirm Order</button></a>
                                        
                                        <br><br>
                                   
                                </div>
                              
                    </section>
                </div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

<style>

</style>
