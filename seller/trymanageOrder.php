<?php
    require __DIR__ . '/header.php'
?>
<?php

if(isset($_GET["ship"])){
    $order_id = $_GET["order_id"];
    $conn->query("UPDATE myorder SET order_status = 'shipping' WHERE order_id = ".$order_id);

    echo "<script>
        alert('Order ID #$order_id has been shipped');
        window.location.href='manageOrder.php';
        </script>";
}
?>

    <!-- Begin Page Content -->
    <div class="container-fluid" style="width:100%;">
    

<div class="container-fluid" style="width:80%">
              <div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#All">All</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#ToShip">To Ship</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#PickUp">To Pick up</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#Shipping">Shipping</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#Completed">Completed</a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#Cancellation">Cancellation</a></li>
    </ul>
    <div class="tab-content">
        <div id="All" class="tab-pane active" role="tabpanel">
      <div class="order-list-panel">
                            <div class="top-card card-header">
                                <div class="row">
                                    <div class="col-5">Product(s)</div>
                                    <div class="col-1">Order Total</div>
                                    <div class="col-2">Status</div>
                                    <div class="col-2">All Channels</div>
                                    <div class="col-2">Actions</div>
                                </div>
                            </div>
                        </div>
            <div class="card mt-2">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col md-auto text-start"><span><strong>USERNAME</strong></span></div></div>
                                        <div class="col md-auto text-end" style="text-align:right;"><span><strong>Order ID:1 </strong></span></div>
                                    </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1 image-container">
                                            <img class="card-img-top img-thumbnail"
                                                style="object-fit:contain;width:100%;height:100%"
                                                 />
                                        </div>
                                        <div class="col-3">
                                            Tool Box
                                        </div>
                                        <div class="col-1">
                                            x
                                           1
                                        </div>

                                        <div class="col-1">
                                            RM
                                            50.00
                                        </div>
                                        <div class="col-2">order status</div>
                                        <div class="col-2">DHL eCommerce 2121113134</div>
                                        <div class="col-2">
                                        <a href="shippingCheckDetails.php?order_id=">Check details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
        <div id="ToShip" class="tab-pane" role="tabpanel">
            <div class="card mt-2">
                                <div class="card-header">
                                    
                                    <div class="row">
                                        <div class="col md-auto text-start"><span><strong>USERNAME</strong></span></div></div>
                                        <div class="col md-auto text-end" style="text-align:right;"><span><strong> </strong></span></div>
                                </div>
                  
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1">
                                           <b>Order ID</b>
                                        </div>
                                        <div class="col-7">
                                            <b>Product Detail</b>
                                        </div>
                                        <div class="col-2"><b>Status</b></div>
                                        <div class="col-2"><b>Action</b></div>
                                    </div>
                                    <hr>

                                    <?php
                                    $sql2 = "SELECT * FROM myOrder WHERE order_status NOT IN ('cancelled', 'shipping') ";
                                    $result2 = $conn->query($sql2);
                                    while($row2 = $result2->fetch_assoc()){
                                        $order_id = $row2['order_id'];
                                    ?>
                                    <div class="row">
                                        <div class="col-1">
                                            <?php echo $order_id; ?>
                                        </div>
                                        <div class="col-7">
                                            <?php
                                            $sql3 = "SELECT * FROM orderDetails JOIN product ON orderDetails.product_id = product.id JOIN shopProfile ON product.shop_id = shopProfile.shop_id WHERE order_id = $order_id";
                                            $result3 = $conn->query($sql3);
                                            while($row3 = $result3->fetch_assoc()){
                                            ?>
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src=/img/product/<?php echo $row3['product_cover_picture']?>>
                                                </div>
                                                <div class="col-5">
                                                    <?php echo $row3['product_name']?>
                                                </div>
                                                <div class="col-1">
                                                   x <?php echo $row3['quantity']?>
                                                </div>
                                                <div class="col-2">
                                                    RM <?php echo $row3['price']?>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-2"><?php echo $row3["order_status"]; ?></div>
                                        <div class="col-2">
                                        <a href="manageOrder.php?ship&order_id=<?php echo $order_id;;?>">Arrange Shipment</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php } ?>
                                </div>
            </div>
        </div>
        <div id="PickUp" class="tab-pane" role="tabpanel">
            <p>Content for tab 3.</p>
        </div>
        <div id="Shipping" class="tab-pane" role="tabpanel">
            <div class="card mt-2">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col md-auto text-start"><span><strong>USERNAME</strong></span></div></div>
                                        <div class="col md-auto text-end" style="text-align:right;"><span><strong>SHIPPING </strong></span></div>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                           <b>Order ID</b>
                                        </div>
                                        <div class="col-7">
                                            <b>Product Detail</b>
                                        </div>
                                        <div class="col-3"><b>Status</b></div>
                                    </div>
                                    <hr>

                                    <?php
                                    $sql = "SELECT * FROM myOrder WHERE order_status IN ('shipping') ";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()){
                                        $order_id = $row['order_id'];
                                    ?>
                                    <div class="row">
                                        <div class="col-2">
                                            <?php echo $order_id; ?>
                                        </div>
                                        <div class="col-7">
                                            <?php
                                            $sql2 = "SELECT * FROM orderDetails JOIN product ON orderDetails.product_id = product.id JOIN shopProfile ON product.shop_id = shopProfile.shop_id WHERE order_id = $order_id";
                                            $result2 = $conn->query($sql2);
                                            while($row2 = $result2->fetch_assoc()){
                                            ?>
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src=/img/product/<?php echo $row2['product_cover_picture']?>>
                                                </div>
                                                <div class="col-5">
                                                    <?php echo $row2['product_name']?>
                                                </div>
                                                <div class="col-1">
                                                   x <?php echo $row2['quantity']?>
                                                </div>
                                                <div class="col-2">
                                                    RM <?php echo $row2['price']?>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-3"><?php echo $row["order_status"]; ?></div>
                                    </div>
                                    <hr>
                                    <?php } ?>
                                </div>
            </div>
        </div>
        <div id="Completed" class="tab-pane" role="tabpanel">
            <p>Content for tab 1.</p>
        </div>
      <div id="Cancellation" class="tab-pane" role="tabpanel">
            <div class="card mt-2">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col md-auto text-start"><span><strong>USERNAME</strong></span></div></div>
                                        <div class="col md-auto text-end" style="text-align:right;"><span><strong>CANCALLED </strong></span></div>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                           <b>Order ID</b>
                                        </div>
                                        <div class="col-7">
                                            <b>Product Detail</b>
                                        </div>
                                        <div class="col-3"><b>Status</b></div>
                                    </div>
                                    <hr>

                                    <?php
                                    $sql = "SELECT * FROM myOrder WHERE order_status IN ('cancelled') ";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()){
                                        $order_id = $row['order_id'];
                                    ?>
                                    <div class="row">
                                        <div class="col-2">
                                            <?php echo $order_id; ?>
                                        </div>
                                        <div class="col-7">
                                            <?php
                                            $sql2 = "SELECT * FROM orderDetails JOIN product ON orderDetails.product_id = product.id JOIN shopProfile ON product.shop_id = shopProfile.shop_id WHERE order_id = $order_id";
                                            $result2 = $conn->query($sql2);
                                            while($row2 = $result2->fetch_assoc()){
                                            ?>
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src=/img/product/<?php echo $row2['product_cover_picture']?>>
                                                </div>
                                                <div class="col-5">
                                                    <?php echo $row2['product_name']?>
                                                </div>
                                                <div class="col-1">
                                                   x <?php echo $row2['quantity']?>
                                                </div>
                                                <div class="col-2">
                                                    RM <?php echo $row2['price']?>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-3"><?php echo $row["order_status"]; ?></div>
                                    </div>
                                    <hr>
                                    <?php } ?>
                                </div>
            </div>
        </div>
    </div>
</div>                   



</div>













    </div>
    <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>