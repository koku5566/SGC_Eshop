<?php
require __DIR__ . '/header.php'
?>

<?php
/*QUERY FOR ALL ORDER */
$sql = "SELECT
DISTINCT myOrder.order_id,
myOrder.order_status,
myOrder.delivery_method,
myOrder.tracking_number,
product.product_name,
product.product_cover_picture,
product.product_price,
orderDetails.quantity,
user.username,
orderDetails.amount
FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN user ON myOrder.user_id = user.user_id
JOIN product ON orderDetails.product_id = product.product_id
ORDER BY myOrder.order_id DESC
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();


/*QUERY FOR TO SHIP */
$toshipsql = "SELECT
DISTINCT myOrder.order_id,
myOrder.order_status,
myOrder.delivery_method,
myOrder.tracking_number,
product.product_name,
product.product_cover_picture,
product.product_price,
orderDetails.quantity,
user.username,
orderDetails.amount
FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN user ON myOrder.user_id = user.user_id
JOIN product ON orderDetails.product_id = product.product_id
WHERE myOrder.order_status = 'Paid'
ORDER BY myOrder.order_id DESC";

$stmt = $conn->prepare($toshipsql);
$stmt->execute();
$toshipresult = $stmt->get_result();

/*QUERY FOR PICK UP */
$pickupsql = "SELECT
DISTINCT myOrder.order_id,
myOrder.order_status,
myOrder.delivery_method,
myOrder.tracking_number,
product.product_name,
product.product_cover_picture,
product.product_price,
orderDetails.quantity,
user.username,
orderDetails.amount
FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN user ON myOrder.user_id = user.user_id
JOIN product ON orderDetails.product_id = product.product_id
WHERE myOrder.delivery_method = 'self-collection' AND myOrder.order_status != 'Ready'
ORDER BY myOrder.order_id DESC";

$stmt = $conn->prepare($pickupsql);
$stmt->execute();
$pickupresult = $stmt->get_result();



/*QUERY FOR SHIPPING */
$shippingsql = "SELECT
DISTINCT myOrder.order_id,
myOrder.order_status,
myOrder.delivery_method,
myOrder.tracking_number,
product.product_name,
product.product_cover_picture,
product.product_price,
orderDetails.quantity,
user.username,
orderDetails.amount
FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN user ON myOrder.user_id = user.user_id
JOIN product ON orderDetails.product_id = product.product_id
WHERE myOrder.order_status != 'Shipped'
ORDER BY myOrder.order_id DESC";

$stmt = $conn->prepare($shippingsql);
$stmt->execute();
$shippingresult = $stmt->get_result();


/*QUERY FOR COMPLETED */
$completedsql = "SELECT
DISTINCT myOrder.order_id,
myOrder.order_status,
myOrder.delivery_method,
myOrder.tracking_number,
product.product_name,
product.product_cover_picture,
product.product_price,
orderDetails.quantity,
user.username,
orderDetails.amount
FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN user ON myOrder.user_id = user.user_id
JOIN product ON orderDetails.product_id = product.product_id
WHERE myOrder.order_status = 'Received'
ORDER BY myOrder.order_id DESC";

$stmt = $conn->prepare($completedsql);
$stmt->execute();
$completedresult = $stmt->get_result();
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
                                        <select class="form-select" name="searchBy" aria-label="SearchBy" style="color:currentColor;">
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
                                    <input type="text" name="daterange" class="form-control js-daterangepicker" value="01/01/2022 - 01/15/2022" />
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
                            <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="toship-tab" data-toggle="tab" href="#toship" role="tab" aria-controls="toship" aria-selected="false">To Ship</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="topickup-tab" data-toggle="tab" href="#topickup" role="tab" aria-controls="topickup" aria-selected="false">To Pick Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="false">Shipping</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
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
                            $sqlkoku1 = "SELECT * FROM `myOrder` INNER JOIN user ON `myOrder`.`user_id` = `user`.`user_id` ";
                            $resultkoku1 = mysqli_query($conn, $sqlkoku1);

                            if (mysqli_num_rows($resultkoku1) > 0) {
                                while ($rowkoku1 = mysqli_fetch_assoc($resultkoku1)) {
                                    //Loop header
                            ?>
                                    <div class="card mt-2">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col md-auto text-start">
                                                    <span><strong><?php echo $rowkoku1['username']; ?></strong></span>
                                                </div>
                                            </div>
                                            <div class="col md-auto text-end" style="text-align:right;">
                                                <span><strong>Order ID:<?php echo $rowkoku1['order_id']; ?> </strong></span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <?php

                                            $oID = $rowkoku1['order_id'];
                                            //Loop product in each order
                                            $sqlkoku2 = "SELECT * FROM `orderDetails` INNER JOIN `myOrder`ON `orderDetails`.`order_id` = `myOrder`.`order_id`
                        INNER JOIN `user` ON `myOrder`.`user_id` = `user`.`user_id`
                        INNER JOIN `product` ON `orderDetails`.`product_id` = `product`.`product_id`
                        WHERE `orderDetails`.`order_id` = $oID";
                                            $resultkoku2 = mysqli_query($conn, $sqlkoku2);
                                            if (mysqli_num_rows($resultkoku2) > 0) {
                                                while ($rowkoku2 = mysqli_fetch_assoc($resultkoku2)) {
                                            ?>
                                                    <div class="row">
                                                        <div class="col-1 image-container">
                                                            <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $rowkoku2['product_cover_picture'] ?>" alt="<?php echo $rowkoku2['product_name'] ?>" />
                                                        </div>
                                                        <div class="col-3">
                                                            <?php echo $rowkoku2['product_name'] ?>
                                                        </div>
                                                        <div class="col-1">
                                                            x
                                                            <?php echo $rowkoku2['quantity'] ?>
                                                        </div>

                                                        <div class="col-1">
                                                            RM
                                                            <?php echo $rowkoku2['product_price'] ?>.00
                                                        </div>
                                                        <div class="col-2"><?php echo $rowkoku2['order_status'] ?></div>
                                                        <div class="col-2"> <?php echo $rowkoku2['tracking_number'] ?></div>
                                                        <div class="col-2">
                                                            <?php if ($rowkoku2['order_status'] == 'Paid') { ?><a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $rowkoku2['order_id']; ?>">Arrange Shipment</a>
                                                            <?php } else if ($rowkoku2['delivery_method'] == 'self-collection' && $rowkoku2['order_status'] == 'Paid') { ?> <a class="btn btn-primary btn-sm" href="shippingCheckDetails.php?order_id=<?php echo $rowkoku2['order_id']; ?>">Update Pick-Up</a>
                                                            <?php } else { ?> <a href="shippingCheckDetails.php?order_id=<?php echo $rowkoku2['order_id']; ?>">Check Details</a><?php } ?>
                                                        </div>
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


                        <!------------- Koku ALL---------------------------------------------------------------------------------------------------------------------------------------------------------- -->


                        <!--------------------------------To ship--------------------------------------->
                        <div class="tab-pane fade" id="toship" role="tabpanel" aria-labelledby="toship-tab">
                            <?php
                            while ($tsrow = $toshipresult->fetch_assoc()) {
                            ?>
                                <!--Each Order Item-->
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col md-auto text-start"><span><strong><?php echo $tsrow['username']; ?></strong></span></div>
                                        </div>
                                        <div class="col md-auto text-end" style="text-align:right;"><span><strong>Order ID:<?php echo $tsrow['order_id']; ?> </strong></span></div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-1 image-container">
                                                <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $tsrow['product_cover_picture'] ?>" alt="<?php echo $tsrow['product_name'] ?>" />
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
                                            <div class="col-2">DHL eCommerce <?php echo $tsrow['tracking_number'] ?></div>
                                            <div class="col-2">
                                                <a href="shippingCheckDetails.php?order_id=<?php echo $tsrow['order_id']; ?>">Arrange Shipment</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Order Item-->
                            <?php
                            } ?>


                        </div>

                        <!--------------------------------Pick Up--------------------------------------->
                        <div class="tab-pane fade" id="topickup" role="tabpanel" aria-labelledby="topickup-tab">
                            <?php
                            while ($purow = $pickupresult->fetch_assoc()) {
                            ?>
                                <!--Each Order Item-->
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col md-auto text-start"><span><strong><?php echo $purow['username']; ?></strong></span></div>
                                        </div>
                                        <div class="col md-auto text-end" style="text-align:right;"><span>Order ID:<?php echo $purow['order_id']; ?> </span></div>
                                    </div>

                                    <div class="card-body">
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
                                            <div class="col-2">DHL eCommerce <?php echo $purow['tracking_number'] ?></div>
                                            <div class="col-2">
                                                <a href="shippingCheckDetails.php?order_id=<?php echo $purow['order_id']; ?>">Update Status</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Order Item-->
                            <?php
                            } ?>
                        </div>

                        <!--------------------------------Shipping--------------------------------------->
                        <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                            <?php
                            while ($shiprow = $shippingresult->fetch_assoc()) {
                            ?>
                                <!--Each Order Item-->
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col md-auto text-start"><span><strong><?php echo $shiprow['username']; ?></strong></span></div>
                                        </div>
                                        <div class="col md-auto text-end" style="text-align:right;"><span><strong>Order ID:<?php echo $shiprow['order_id']; ?> </strong></span></div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-1 image-container">
                                                <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $shiprow['product_cover_picture'] ?>" alt="<?php echo $shiprow['product_name'] ?>" />
                                            </div>
                                            <div class="col-3">
                                                <?php echo $shiprow['product_name'] ?>
                                            </div>
                                            <div class="col-1">
                                                x
                                                <?php echo $shiprow['quantity'] ?>
                                            </div>

                                            <div class="col-1">
                                                RM
                                                <?php echo $shiprow['product_price'] ?>.00
                                            </div>
                                            <div class="col-2"><?php echo $shiprow['order_status'] ?></div>
                                            <div class="col-2">DHL eCommerce <?php echo $shiprow['tracking_number'] ?></div>
                                            <div class="col-2">
                                                <a href="shippingCheckDetails.php?order_id=<?php echo $shiprow['order_id']; ?>">Check Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Order Item-->
                            <?php
                            } ?>
                        </div>

                        <!--------------------------------Completed--------------------------------------->
                        <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                            <?php
                            while ($crow = $completedresult->fetch_assoc()) {
                            ?>
                                <!--Each Order Item-->
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col md-auto text-start"><span><strong><?php echo $crow['username']; ?></strong></span></div>
                                        </div>
                                        <div class="col md-auto text-end" style="text-align:right;"><span><strong>Order ID:<?php echo $crow['order_id']; ?> </strong></span></div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-1 image-container">
                                                <img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $crow['product_cover_picture'] ?>" alt="<?php echo $crow['product_name'] ?>" />
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
                                            <div class="col-2">DHL eCommerce <?php echo $crow['tracking_number'] ?></div>
                                            <div class="col-2">
                                                <a href="shippingCheckDetails.php?order_id=<?php echo $crow['order_id']; ?>">Check Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Order Item-->
                            <?php
                            } ?>
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
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>