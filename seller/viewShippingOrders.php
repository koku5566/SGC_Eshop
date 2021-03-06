<?php
    require __DIR__ . '/header.php'
?>

<?php
$user_id = $_SESSION["userid"];
// /*QUERY FOR ALL ORDER */
// $sql = "SELECT
// DISTINCT myOrder.order_id,
// myOrder.order_status,
// myOrder.delivery_method,
// myOrder.tracking_number,
// product.product_name,
// product.product_cover_picture,
// product.product_price,
// orderDetails.quantity,
// user.username,
// orderDetails.amount
// FROM
// myOrder
// JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
// JOIN user ON myOrder.user_id = user.user_id
// JOIN product ON orderDetails.product_id = product.product_id
// WHERE orderDetails.shop_id = '$user_id'
// ORDER BY myOrder.order_id DESC
// ";

// $stmt = $conn->prepare($sql);
// $stmt->execute();
// $result = $stmt->get_result();


// /*QUERY FOR TO SHIP */
// $allsql = "SELECT
// DISTINCT myOrder.order_id,
// myOrder.order_status,
// myOrder.delivery_method,
// myOrder.tracking_number,
// product.product_name,
// product.product_cover_picture,
// product.product_price,
// orderDetails.quantity,
// user.username,
// orderDetails.amount
// FROM
// myOrder
// JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
// JOIN user ON myOrder.user_id = user.user_id
// JOIN product ON orderDetails.product_id = product.product_id
// WHERE myOrder.order_status = 'Paid'
// AND myOrder.user_id = '$user_id'
// ORDER BY myOrder.order_id DESC";

// $stmt = $conn->prepare($allsql);
// $stmt->execute();
// $aallresult = $stmt->get_result();

// /*QUERY FOR PICK UP */
// $pickupsql = "SELECT
// DISTINCT myOrder.order_id,
// myOrder.order_status,
// myOrder.delivery_method,
// myOrder.tracking_number,
// product.product_name,
// product.product_cover_picture,
// product.product_price,
// orderDetails.quantity,
// user.username,
// orderDetails.amount
// FROM
// myOrder
// JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
// JOIN user ON myOrder.user_id = user.user_id
// JOIN product ON orderDetails.product_id = product.product_id
// WHERE myOrder.delivery_method = 'self-collection' AND myOrder.order_status != 'Ready' AND myOrder.user_id = '$user_id'
// ORDER BY myOrder.order_id DESC";

// $stmt = $conn->prepare($pickupsql);
// $stmt->execute();
// $pickupresult = $stmt->get_result();



// /*QUERY FOR SHIPPING */
// $shippingsql = "SELECT
// DISTINCT myOrder.order_id,
// myOrder.order_status,
// myOrder.delivery_method,
// myOrder.tracking_number,
// product.product_name,
// product.product_cover_picture,
// product.product_price,
// orderDetails.quantity,
// user.username,
// orderDetails.amount
// FROM
// myOrder
// JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
// JOIN user ON myOrder.user_id = user.user_id
// JOIN product ON orderDetails.product_id = product.product_id
// WHERE myOrder.order_status != 'Shipped' 
// AND myOrder.user_id = '$user_id'
// ORDER BY myOrder.order_id DESC";

// $stmt = $conn->prepare($shippingsql);
// $stmt->execute();
// $shippingresult = $stmt->get_result();


// /*QUERY FOR COMPLETED */
// $completedsql = "SELECT
// DISTINCT myOrder.order_id,
// myOrder.order_status,
// myOrder.delivery_method,
// myOrder.tracking_number,
// product.product_name,
// product.product_cover_picture,
// product.product_price,
// orderDetails.quantity,
// user.username,
// orderDetails.amount
// FROM
// myOrder
// JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
// JOIN user ON myOrder.user_id = user.user_id
// JOIN product ON orderDetails.product_id = product.product_id
// WHERE myOrder.order_status = 'Received'
// AND myOrder.user_id = '$user_id'
// ORDER BY myOrder.order_id DESC";

// $stmt = $conn->prepare($completedsql);
// $stmt->execute();
// $completedresult = $stmt->get_result();
?>




<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%; font-size:14px">

    <!-- Order Filter -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Filter Order</h5>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <form action="searchShippingOrders.php" method="GET">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-sm-12" style="padding-bottom: .625rem;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <select class="form-select" name="searchBy" aria-label="SearchBy"
                                            style="color:currentColor;">
                                            <option selected value="id">Order ID</option>
                                            <option value="seller">Seller</option>
                                            <option value="name">Buyer Name</option>
                                            <option value="product">Product</option>
                                            <option value="trackingnumber">Tracking Number</option>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control" name="keyword" placeholder="Search order">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-sm-12" style="padding-bottom: .625rem;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Order Date</span>
                                    </div>
                                    <input type="text" name="daterange" class="form-control js-daterangepicker"
                                        value="01/01/2022 - 01/15/2022" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-10 col-lg-8 col-sm-4" style="padding-bottom: .625rem;">

                            </div>
                            <div class="col-xl-1 col-lg-2 col-sm-4" style="padding-bottom: .625rem;">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                            <div class="col-xl-1 col-lg-2 col-sm-4" style="padding-bottom: .625rem;">
                                <button type="button" class="btn btn-outline-dark">Reset</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12" style="padding-bottom: .625rem;">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab"
                                aria-controls="all" aria-selected="true">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="toship-tab" data-toggle="tab" href="#toship" role="tab"
                                aria-controls="toship" aria-selected="false">To Ship</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="topickup-tab" data-toggle="tab" href="#topickup" role="tab"
                                aria-controls="topickup" aria-selected="false">To Pick Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab"
                                aria-controls="shipping" aria-selected="false">Shipping</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab"
                                aria-controls="completed" aria-selected="false">Completed</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content mb-3">


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
                        <!--------------------------------All-------------------------------------->
                        <div class="tab-pane show active fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                            
                            <?php       
                              $sqlheader = "SELECT * FROM myOrder INNER JOIN user ON myOrder.userID = user.user_id JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id WHERE productTransaction.shop_id = '$user_id' ORDER BY myOrder.order_id DESC";
                              $resultheader = mysqli_query($conn, $sqlheader);
                              if (mysqli_num_rows($resultheader) > 0) {
                              while ($rowheader = mysqli_fetch_assoc($resultheader)) {
                                $i=0;
                                //Loop header
                              ?>
                                    <div class="card mt-2">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col md-auto text-start">
                                                    <span><strong><?php echo $rowheader['username']; ?></strong></span>
                                                </div>
                                                <div class="col md-auto text-end" style="text-align:right;">
                                                <span class="pr-1"><strong>Order ID:<?php echo $rowheader['invoice_id']; ?> </strong></span>|<span class="pl-1"><strong><?php echo $rowheader['delivery_method'] ?> </strong></span>
                                            </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <?php

                                            $aoID = $rowheader['invoice_id'];
                                            //Loop product in each order
                                            $allsql = "SELECT * FROM productTransaction INNER JOIN myOrder ON productTransaction.invoice_id  = myOrder.invoice_id
                                                        INNER JOIN user ON myOrder.userID = user.user_id
                                                        INNER JOIN product ON productTransaction.product_id = product.product_id
                                                        WHERE productTransaction.invoice_id = '$aoID' AND productTransaction.shop_id = '$user_id' ORDER BY myOrder.order_id DESC ";
                                                        /*SELECT * FROM orderDetails INNER JOIN myOrder ON orderDetails.order_id = myOrder.order_id
                                                        INNER JOIN user ON myOrder.userID = user.user_id
                                                        INNER JOIN product ON orderDetails.product_id = product.product_id
                                                        WHERE orderDetails.order_id = '$aoID' AND orderDetails.shop_id = '$user_id' */
                                          
                                            $allresult = mysqli_query($conn, $allsql);
                                            if (mysqli_num_rows($allresult) > 0) {
                                               
                                                while ($arow = mysqli_fetch_assoc($allresult)) {
                                                   
                                            ?>
                                                    <div class="row">
                                                        <div class="col-1 image-container">
                                                            <img class="card-img-top" style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $arow['product_cover_picture'] ?>" alt="<?php echo $arow['product_name'] ?>" />
                                                    </div>
                                                        <div class="col-3">
                                                            <?php echo $arow['product_name'] ?>
                                                        </div>
                                                        <div class="col-1">
                                                            x
                                                            <?php echo $arow['quantity'] ?>
                                                        </div>

                                                        <div class="col-1">
                                                            RM
                                                            <?php echo $arow['product_price'] ?>.00
                                                        </div>
                                                        <div class="col-2"><?php echo $arow['order_status'] ?></div>
                                                        <div class="col-2"> <?php echo $arow['tracking_number'] ?></div>
                                                            <?php 
                                                            while($i < 1){?>
                                                                <div class="col-2">
                                                                <?php 
                                                                if ($arow['order_status'] == 'Paid' && $arow['delivery_method'] == 'standard-delivery') { ?><a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $arow['invoice_id']; ?>">Arrange Shipment</a>
                                                                <?php } else if ($arow['delivery_method'] == 'self-collection' && $arow['order_status'] == 'Paid') { ?> <a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $arow['invoice_id']; ?>">Update Pick-Up</a>
                                                                <?php } else { ?> <a href="shippingCheckDetails.php?order_id=<?php echo $arow['invoice_id']; ?>">Check Details</a><?php } ?>
                                                                </div>
                                                            <?php 
                                                             $i++;
                                                            }
                                                           ?>
                                                        
                                                    </div>
                                            <?php
                                                }
                                            }else
                                            echo("cannot");
                                            ?>
                                        </div>
                                    </div>
                            <?php

                                }
                            }
                            ?>
                            </div>
                                <!--End of Order Item-->

                            <!--------------------------------To ship--------------------------------------->
                            <div class="tab-pane fade" id="toship" role="tabpanel" aria-labelledby="toship-tab">
                            <?php       
                            
                              $sqltsheader = "SELECT * FROM myOrder INNER JOIN user ON myOrder.userID = user.user_id INNER JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id
                               WHERE myOrder.order_status = 'Paid' AND productTransaction.shop_id = '$user_id'AND myOrder.delivery_method = 'standard-delivery' ";
                              $tsresultheader = mysqli_query($conn, $sqltsheader);
                              if (mysqli_num_rows($tsresultheader) > 0) {
                              while ($tsrowheader = mysqli_fetch_assoc($tsresultheader)) {
                                $i=0;
                              //Loop header
                              ?>
                                    <div class="card mt-2">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col md-auto text-start">
                                                    <span><strong><?php echo $tsrowheader['username']; ?></strong></span>
                                                </div>
                                                <div class="col md-auto text-end" style="text-align:right;">
                                                <span class="pr-1">
                                                    <strong>Order ID:<?php echo $tsrowheader['invoice_id']; ?> </strong></span>|<span class="pl-1"><strong><?php echo $tsrowheader['delivery_method'] ?></strong>
                                                </span>
                                            </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <?php

                                            $toID = $tsrowheader['invoice_id'];
                                            //Loop product in each order

                                            $tssql = "SELECT * FROM productTransaction INNER JOIN myOrder ON productTransaction.invoice_id = myOrder.invoice_id
                                                        INNER JOIN user ON myOrder.userID = user.user_id
                                                        INNER JOIN product ON productTransaction.product_id = product.product_id
                                                        WHERE productTransaction.invoice_id = '$toID' 
                                                        AND productTransaction.shop_id = '$user_id' 
                                                        AND myOrder.order_status = 'Paid' 
                                                        AND myOrder.delivery_method = 'standard-delivery'  
                                                        ORDER BY myOrder.order_id DESC";
                                            
                                            $tsresult = mysqli_query($conn, $tssql);
                                            if (mysqli_num_rows($tsresult) > 0) {
                                                while ($tsrow = mysqli_fetch_assoc($tsresult)) {
                                            ?>
                                                    <div class="row">
                                                        <div class="col-1 image-container">
                                                            <img class="card-img-top" style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $tsrow['product_cover_picture'] ?>" alt="<?php echo $tsrow['product_name'] ?>" />
                                                        </div>
                                                        <div class="col-3">
                                                            <?php echo $tsrow['product_name'] ?>
                                                        </div>
                                                        <div class="col-1">
                                                            x
                                                            <?php echo $tsrow['quantity'] ?>
                                                        </div>

                                                        <div class="col-1">
                                                            RM
                                                            <?php echo $tsrow['product_price'] ?>.00
                                                        </div>
                                                        <div class="col-2"><?php echo $tsrow['order_status'] ?></div>
                                                        <div class="col-2"> <?php echo $tsrow['tracking_number'] ?></div>
                                                        <?php 
                                                            while($i < 1){?>
                                                                <div class="col-2">
                                                                <?php 
                                                                if ($tsrow['order_status'] == 'Paid' && $tsrow['delivery_method'] == 'standard-delivery') { ?><a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $tsrow['invoice_id']; ?>">Arrange Shipment</a>
                                                                <?php } else if ($tsrow['delivery_method'] == 'self-collection' && $tsrow['order_status'] == 'Paid') { ?> <a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $tsrow['invoice_id']; ?>">Update Pick-Up</a>
                                                                <?php } else { ?> <a href="shippingCheckDetails.php?order_id=<?php echo $arow['invoice_id']; ?>">Check Details</a><?php } ?>
                                                                </div>
                                                            <?php 
                                                             $i++;
                                                            }
                                                           ?>
                                                    </div>
                                            <?php
                                                }
                                            }else
                                            echo("cannot");
                                            ?>
                                        </div>
                                    </div>
                            <?php

                                }
                            }
                            ?>


                            </div>

                            <!--------------------------------Pick Up--------------------------------------->
                            <div class="tab-pane fade" id="topickup" role="tabpanel" aria-labelledby="topickup-tab">
                            <?php       
                              $sqlpuheader = "SELECT * FROM myOrder INNER JOIN user ON myOrder.userID = user.user_id INNER JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id WHERE myOrder.delivery_method = 'self-collection' AND myOrder.order_status ='Paid' AND productTransaction.shop_id = '$user_id' ORDER BY myOrder.order_id DESC";
                              $puresultheader = mysqli_query($conn, $sqlpuheader);
                              if (mysqli_num_rows($puresultheader) > 0) {
                              while ($purowheader = mysqli_fetch_assoc($puresultheader)) {
                                $i=0;
                              //Loop header
                              ?>
                                    <div class="card mt-2">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col md-auto text-start">
                                                    <span><strong><?php echo $purowheader['username']; ?></strong></span>
                                                </div>
                                                <div class="col md-auto text-end" style="text-align:right;">
                                                <span class="pr-1"><strong>Order ID:<?php echo $purowheader['invoice_id']; ?> </strong></span>|<span class="pl-1"><strong><?php echo $purowheader['delivery_method'] ?> </strong></span>

                                            </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <?php

                                            $poID = $purowheader['invoice_id'];
                                            //Loop product in each order

                                            $pusql = "SELECT * FROM productTransaction INNER JOIN myOrder ON productTransaction.invoice_id = myOrder.invoice_id
                                                        INNER JOIN user ON myOrder.userID = user.user_id
                                                        INNER JOIN product ON productTransaction.product_id = product.product_id
                                                        WHERE productTransaction.invoice_id = '$poID' AND productTransaction.shop_id = '$user_id' AND myOrder.delivery_method = 'self-collection' AND myOrder.order_status = 'Paid' ORDER BY myOrder.order_id DESC";
                                            
                                            $puresult = mysqli_query($conn, $pusql);
                                            if (mysqli_num_rows($puresult) > 0) {
                                                while ($purow = mysqli_fetch_assoc($puresult)) {
                                            ?>
                                                    <div class="row">
                                                        <div class="col-1 image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $purow['product_cover_picture'] ?>" alt="<?php echo $purow['product_name'] ?>" />
                                                        </div>
                                                        <div class="col-3">
                                                            <?php echo $purow['product_name'] ?>
                                                        </div>
                                                        <div class="col-1">
                                                            x
                                                            <?php echo $purow['quantity'] ?>
                                                        </div>

                                                        <div class="col-1">
                                                            RM
                                                            <?php echo $purow['product_price'] ?>.00
                                                        </div>
                                                        <div class="col-2"><?php echo $purow['order_status'] ?></div>
                                                        <div class="col-2"> <?php echo $purow['tracking_number'] ?></div>
                                                        <?php 
                                                            while($i < 1){?>
                                                                <div class="col-2">
                                                                <?php 
                                                                if ($purow['order_status'] == 'Paid' && $purow['delivery_method'] == 'standard-delivery') { ?><a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $purow['invoice_id']; ?>">Arrange Shipment</a>
                                                                <?php } else if ($purow['delivery_method'] == 'self-collection' && $purow['order_status'] == 'Paid') { ?> <a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $purow['invoice_id']; ?>">Update Pick-Up</a>
                                                                <?php } else { ?> <a href="shippingCheckDetails.php?order_id=<?php echo $purow['invoice_id']; ?>">Check Details</a><?php } ?>
                                                                </div>
                                                            <?php 
                                                             $i++;
                                                            }
                                                           ?>
                                                    </div>
                                            <?php
                                                }
                                            }else
                                            echo("cannot");
                                            ?>
                                        </div>
                                    </div>
                            <?php

                                }
                            }
                            ?>
                            </div>

                            <!--------------------------------Shipping--------------------------------------->
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                            <?php       
                              $sqlsheader = "SELECT * FROM myOrder INNER JOIN user ON myOrder.userID = user.user_id INNER JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id WHERE myOrder.order_status = 'Shipped' AND productTransaction.shop_id = '$user_id' ORDER BY myOrder.order_id DESC";
                              $sresultheader = mysqli_query($conn, $sqlsheader);
                              if (mysqli_num_rows($sresultheader) > 0) {
                              while ($srowheader = mysqli_fetch_assoc($sresultheader)) {
                                $i=0;
                              //Loop header
                              ?>
                                    <div class="card mt-2">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col md-auto text-start">
                                                    <span><strong><?php echo $srowheader['username']; ?></strong></span>
                                                </div>
                                                <div class="col md-auto text-end" style="text-align:right;">
                                                    <span class="pr-1"><strong>Order ID:<?php echo $srowheader['invoice_id']; ?> </strong></span>|<span class="pl-1"><strong><?php echo $srowheader['delivery_method'] ?> </strong></span>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <?php

                                            $soID = $srowheader['invoice_id'];
                                            //Loop product in each order
                                            $ssql = "SELECT * FROM productTransaction INNER JOIN myOrder ON productTransaction.invoice_id = myOrder.invoice_id
                                                        INNER JOIN user ON myOrder.userID = user.user_id
                                                        INNER JOIN product ON productTransaction.product_id = product.product_id
                                                        WHERE productTransaction.invoice_id = '$soID' AND productTransaction.shop_id = '$user_id'  AND myOrder.order_status = 'Shipped' ORDER BY myOrder.order_id DESC";
                                            
                                            $sresult = mysqli_query($conn, $ssql);
                                            if (mysqli_num_rows($sresult) > 0) {
                                                while ($srow = mysqli_fetch_assoc($sresult)) {
                                            ?>
                                                    <div class="row">
                                                        <div class="col-1 image-container">
                                                            <img class="card-img-top " style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $srow['product_cover_picture'] ?>" alt="<?php echo $srow['product_name'] ?>" />
                                                        </div>
                                                        <div class="col-3">
                                                            <?php echo $srow['product_name'] ?>
                                                        </div>
                                                        <div class="col-1">
                                                            x
                                                            <?php echo $srow['quantity'] ?>
                                                        </div>

                                                        <div class="col-1">
                                                            RM
                                                            <?php echo $srow['product_price'] ?>.00
                                                        </div>
                                                        <div class="col-2"><?php echo $srow['order_status'] ?></div>
                                                        <div class="col-2"> <?php echo $srow['tracking_number'] ?></div>
                                                        <?php 
                                                            while($i < 1){?>
                                                                <div class="col-2">
                                                                <?php 
                                                                if ($srow['order_status'] == 'Paid' && $srow['delivery_method'] == 'standard-delivery') { ?><a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $srow['invoice_id']; ?>">Arrange Shipment</a>
                                                                <?php } else if ($srow['delivery_method'] == 'self-collection' && $srow['order_status'] == 'Paid') { ?> <a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $srow['invoice_id']; ?>">Update Pick-Up</a>
                                                                <?php } else { ?> <a href="shippingCheckDetails.php?order_id=<?php echo $srow['invoice_id']; ?>">Check Details</a><?php } ?>
                                                                </div>
                                                            <?php 
                                                             $i++;
                                                            }
                                                           ?>
                                                    </div>
                                            <?php
                                                }
                                            }else
                                            echo("cannot");
                                            ?>
                                        </div>
                                    </div>
                            <?php

                                }
                            }
                            ?>
                            </div>

                            <!--------------------------------Completed--------------------------------------->
                            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                            <?php       
                              $sqlcheader = "SELECT * FROM myOrder INNER JOIN user ON myOrder.userID = user.user_id INNER JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id WHERE myOrder.order_status = 'Delivered' OR myOrder.order_status ='Completed' AND productTransaction.shop_id = '$user_id' ORDER BY myOrder.order_id DESC ";
                              $cresultheader = mysqli_query($conn, $sqlcheader);
                              if (mysqli_num_rows($cresultheader) > 0) {
                              while ($crowheader = mysqli_fetch_assoc($cresultheader)) {
                                $i=0;
                              //Loop header
                              ?>
                                    <div class="card mt-2">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col md-auto text-start">
                                                    <span><strong><?php echo $crowheader['username']; ?></strong></span>
                                                </div>
                                                <div class="col md-auto text-end" style="text-align:right;">
                                                    <span class="pr-1"><strong>Order ID:<?php echo $crowheader['invoice_id']; ?> </strong></span>|<span class="pr-1"><strong><?php echo $crowheader['delivery_method'] ?> </strong></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <?php

                                            $coID = $crowheader['invoice_id'];
                                            //Loop product in each order
                                            $csql = "SELECT * FROM productTransaction INNER JOIN myOrder ON productTransaction.invoice_id = myOrder.invoice_id
                                                        INNER JOIN user ON myOrder.userID = user.user_id
                                                        INNER JOIN product ON productTransaction.product_id = product.product_id
                                                        WHERE productTransaction.invoice_id = '$coID' AND productTransaction.shop_id = '$user_id'  AND myOrder.order_status = 'Completed' OR myOrder.order_status = 'Delivered' ORDER BY myOrder.order_id DESC";
                                            
                                            $cresult = mysqli_query($conn, $csql);
                                            if (mysqli_num_rows($sresult) > 0) {
                                                while ($crow = mysqli_fetch_assoc($cresult)) {
                                            ?>
                                                    <div class="row">
                                                        <div class="col-1 image-container">
                                                            <img class="card-img-top " style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $crow['product_cover_picture'] ?>" alt="<?php echo $crow['product_name'] ?>" />
                                                        </div>
                                                        <div class="col-3">
                                                            <?php echo $crow['product_name'] ?>
                                                        </div>
                                                        <div class="col-1">
                                                            x
                                                            <?php echo $crow['quantity'] ?>
                                                        </div>

                                                        <div class="col-1">
                                                            RM
                                                            <?php echo $crow['product_price'] ?>.00
                                                        </div>
                                                        <div class="col-2"><?php echo $crow['order_status'] ?></div>
                                                        <div class="col-2"> <?php echo $crow['tracking_number'] ?></div>
                                                        <?php 
                                                            while($i < 1){?>
                                                                <div class="col-2">
                                                                <?php 
                                                                if ($crow['order_status'] == 'Paid' && $crow['delivery_method'] == 'standard-delivery') { ?><a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $crow['invoice_id']; ?>">Arrange Shipment</a>
                                                                <?php } else if ($crow['delivery_method'] == 'self-collection' && $crow['order_status'] == 'Paid') { ?> <a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $crow['invoice_id']; ?>">Update Pick-Up</a>
                                                                <?php } else { ?> <a href="shippingCheckDetails.php?order_id=<?php echo $crow['invoice_id']; ?>">Check Details</a><?php } ?>
                                                                </div>
                                                            <?php 
                                                             $i++;
                                                            }
                                                           ?>
                                                    </div>
                                            <?php
                                                }
                                            }else
                                            echo("cannot");
                                            ?>
                                        </div>
                                    </div>
                            <?php

                                }
                            }
                            ?>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
    <!--Date Picker-->

    <?php
    require __DIR__ . '/footer.php'
?>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>

        //Date picker function
        $(function () {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });

    </script>
   