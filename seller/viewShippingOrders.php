<?php
    require __DIR__ . '/header.php'
?>

<?php
/*QUERY FOR ORDER*/
$sql = "SELECT
myOrder.order_id,
myOrder.order_status,
myOrder.delivery_method,
product.product_name,
product.product_cover_picture,
product.product_price,
orderDetails.quantity,
orderDetails.price,
user.username,
user.user_id
FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN user ON myOrder.user_id = user.user_id
JOIN product ON orderDetails.product_id = product.id
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<?php
/*to ship sql*/
$sql = "SELECT
myOrder.order_id,
myOrder.order_status,
product.product_name,
product.product_cover_picture,
product.product_price,
product.product_variation,
orderDetails.quantity,
orderDetails.price,
shopProfile.shop_name
FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN product ON orderDetails.product_id = product.id
JOIN shopProfile ON product.shop_id = shopprofile.shop_id
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();




$sql_toship = "SELECT
myOrder.order_id,
myOrder.order_status,
product.product_name,
product.product_cover_picture,
product.product_price,
product.product_variation,
orderDetails.quantity,
orderDetails.price,
shopProfile.shop_name
FROM
myOrder
JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
JOIN product ON orderDetails.product_id = product.id
JOIN shopProfile ON product.shop_id = shopprofile.shop_id
";

$stmt_toship = $conn->prepare($sql_toship);
$stmt_toship->execute();
$toship = $stmt_toship->get_result();
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
                            while ($row = $result->fetch_assoc()) {
                            ?>
                            <!--Each Order Item-->
                            <div class="card mt-2">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col md-auto text-start"><span><strong><?php echo $row['username'];?></strong></span></div></div>
                                        <div class="col md-auto text-end" style="text-align:right;"><span><strong>Order ID:<?php echo $row['order_id']; ?> </strong></span></div>
                                    </div>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1 image-container">
                                            <img class="card-img-top img-thumbnail"
                                                style="object-fit:contain;width:100%;height:100%"
                                                src="/img/product/<?php echo $row['product_cover_picture']?>"
                                                alt="<?php echo $row['product_name']?>" />
                                        </div>
                                        <div class="col-3">
                                            <?php echo $row['product_name']?>
                                        </div>
                                        <div class="col-1">
                                            x
                                            <?php echo $row['quantity']?>
                                        </div>

                                        <div class="col-1">
                                            RM
                                            <?php echo $row['product_price']?>.00
                                        </div>
                                        <div class="col-2"><?php echo $row['order_status'] ?></div>
                                        <div class="col-2">DHL eCommerce 2121113134</div>
                                        <div class="col-2">
                                        <a href="shippingCheckDetails.php?orderid=<?php echo $row['order_id'];?>">Check details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!--End of Order Item-->
                                <?php 
                                }?>


                            </div>
                            <!--------------------------------To ship--------------------------------------->
                            <div class="tab-pane fade" id="toship" role="tabpanel" aria-labelledby="toship-tab">
                                我要SHOW在这里
                                你咋就不行leh
                               
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col md-auto text-start"><span><strong>SEGI PENANG</strong></span></div></div>
                                            <div class="col md-auto text-end" style="text-align:right;"><span><strong>Order ID:6 </strong></span>
                                            </div>
                                        </div> 
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-1 image-container">
                                                    <img class="card-img-top img-thumbnail"
                                                        style="object-fit:contain;width:100%;height:100%"
                                                        src="/img/product/<?php echo $row['product_cover_picture']?>"
                                                        alt="<?php echo $row['product_name']?>" />
                                                </div>
                                                <div class="col-3">
                                                    PRODUCT NAME
                                                </div>
                                                <div class="col-1">
                                                    x
                                                   1
                                                </div>

                                                <div class="col-1">
                                                    RM
                                                   1000.00
                                                </div>
                                                <div class="col-2">TO PROCESS</div>
                                                <div class="col-2">DHL eCommerce 2121113134</div>
                                                <div class="col-2">
                                                <a href="shippingCheckDetails.php?orderid=<?php echo $row['order_id'];?>">Check details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            
                            <!--------------------------------Pick Up--------------------------------------->
                            <div class="tab-pane fade" id="topickup" role="tabpanel" aria-labelledby="topickup-tab">...
                                yomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomamayomama
                            </div>

                            <!--------------------------------Shipping--------------------------------------->
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                yopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapayopapa
                            </div>

                            <!--------------------------------Completed--------------------------------------->
                            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                yosis
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
   