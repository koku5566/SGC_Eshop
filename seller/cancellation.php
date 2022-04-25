<?php
    require __DIR__ . '/header.php'
?>

    <!-- Begin Page Content -->
    <div class="container-fluid" style="width:100%;">
    <div class="card mt-2">
                                
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                           <b>Order ID</b>
                                        </div>
                                        <div class="col-6">
                                            <b>Product Detail</b>
                                        </div>
                                        <div class="col-2"><b>Status</b></div>
                                        <div class="col-2"><b>Actions</b></div>
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
                                            $sql2 = "SELECT
                                            DISTINCT
                                            *
                                            FROM
                                            myOrder
                                            JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id
                                            JOIN product ON productTransaction.product_id = product.product_id
                                            JOIN shopProfile ON product.shop_id = shopProfile.shop_id
                                            JOIN user on myOrder.userID = user.user_id 
                                            WHERE order_id = '$order_id'";
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
                                                   x <?php echo $row2['order_status']?>
                                                </div>
                                                <div class="col-2">
                                                    
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
    <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>