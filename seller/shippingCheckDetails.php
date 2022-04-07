<?php
    require __DIR__ . '/header.php';

    $orderid = $_GET['order_id'];
    
    echo $orderid;
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
    userAddress.address
    FROM
    myOrder
    JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
    JOIN user ON myOrder.user_id = user.user_id
    JOIN product ON orderDetails.product_id = product.id
    JOIN userAddress ON myOrder.user_id = userAddress.user_id
    WHERE myOrder.order_id = '$orderid'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%; font-size:14px">
<?php                       
while ($row = $result->fetch_assoc()) {
?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container m-3">
                <div class="order-section mb-3">
                    <div class="row">
                        <div class="col-1"><i class="fa fa-hashtag"></i></div>
                        <div class="col title">Order ID</div>
                    </div>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col section-body ">
                            <?php echo $row['order_id']?>
                        </div>
                    </div>
                </div>
                <div class="delivery-section mb-3">
                    <div class="row">
                        <div class="col-1"><i class="fa fa-location-dot"></i></div>
                        <div class="col title ">Delivery Address</div>
                    </div>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col section-body">
                            <div id="recipient-name">Hoe Chian Xin</div>
                            <div id="recipient-address"><?php echo $row['address']?></div>
                        </div>
                    </div>
                </div>
                <div class="logistic-section mb-3">
                    <div class="row">
                        <div class="col-1"><i class="fa fa-truck"></i></div>
                        <div class="col title">Shipping Information</div>
                    </div>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col section-body">
                            <!--Shipping Progress table-->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Location</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php } ?>

    <!--  Payment Information -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Payment Information</h5>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="order-list-panel">
                        <div class="top-card card-header">
                            <div class="row">
                                <div class="col-1">No.</div>
                                <div class="col-5">Product</div>
                                <div class="col-2">Unit Price</div>
                                <div class="col-1">Quantity</div>
                                <div class="col-3">Total Price</div>
                            </div>
                        </div>
                    </div>
                    <!--Start of order item-->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">1.</div>
                                <div class="col-1"><img width="100%" src="https://www.w3schools.com/images/w3schools_green.jpg" alt="W3Schools.com"></div>
                                <div class="col-4">Wireless Earphone dfdfbdfbd</div>
                                <div class="col-2">RM349.00</div>
                                <div class="col-1">X1</div>
                                <div class="col-3 red-text">RM349.00</div>
                            </div>
                        </div>
                    </div>
                    <!--End of Order Item-->
                    <div class="row">
                        <!--Payment method & Status-->
                        <div class="col-8">
                            <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2">
                                <div class="w-100 text-start"><span class="text-medium p-2"><strong> Payment
                                            Method:</strong></span><span class="iconify" data-icon="bi:credit-card"
                                        style="color: black; width: 30px;height:30px"></span><span class="p-2">Credit
                                        Card</span> </div>
                                <div class="w-100 text-start"><span class="text-medium"><strong>Status:</strong></span>
                                    <span class="iconify" data-icon="carbon:delivery"
                                        style="color: black;"></span>Processing
                                    Order</div>
                            </div>
                        </div>
                        <!--Ordered Item Price Amount Information-->
                        <div class="col-4">
                            <div class="row p-2">
                                <!-- Total Amount-->
                                <div class="col">
                                    Total:
                                </div>
                                <div class="col">
                                    RM715.00
                                </div>
                            </div>
                            <div class="row p-2">
                                <!--Discounts-->
                                <div class="col">
                                    Discounts:
                                </div>
                                <div class="col">
                                    -RM258.00
                                </div>
                            </div>
                            <div class="row p-2">
                                <!-- Delivery Fees-->
                                <div class="col">
                                    Delivery Fees:
                                </div>
                                <div class="col">
                                    RM8.60
                                </div>
                            </div>
                            <div class="row p-2">
                                <!-- Ordered Total-->
                                <div class="col">
                                    <h5>Ordered Total:</h5>
                                    <!--**to input quantity of items-->
                                </div>
                                <div class="col red-text">
                                    <h5><strong>RM465.60</strong></h5>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<!--Date Picker-->
<script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>



</script>
<?php
    require __DIR__ . '/footer.php'
?>

<style>
    .title {
        font-weight: bold;
    }

    .red-text {
        color: #A71337;
        font-weight: bold;
    }
</style>