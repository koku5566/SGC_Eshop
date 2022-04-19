<?php
    require __DIR__ . '/header.php';

    $orderid = $_GET['order_id'];
    
    //=========sql to get order information=============
    $orderstatus = "";
    $deliverymethod="";
    $totalprice = 0;
    $shippingfee = 8.6;
    $orderinfosql = "SELECT
    myOrder.order_id,
    myOrder.order_status,
    myOrder.delivery_method,
    user.username,
    userAddress.address
    FROM
    myOrder
    JOIN user ON myOrder.user_id = user.user_id
    JOIN userAddress ON myOrder.user_id = userAddress.user_id
    WHERE myOrder.order_id = '$orderid';";
    $stmt = $conn->prepare($orderinfosql);
    $stmt->execute();
    $oresult = $stmt->get_result();
    while ($orow = $oresult->fetch_assoc()) {
        $orderid = $orow['order_id'];
        $orderstatus = $orow['order_status'];
        $deliverymethod = $orow['delivery_method'];
        $username = $orow['username'];
        $address = $orow['address'];
    }

    //=========sql to get order item information===========
    $sql = "SELECT
    myOrder.order_id,
    myOrder.order_status,
    product.product_name,
    product.product_cover_picture,
    product.product_price,
    orderDetails.quantity,
    orderDetails.amount,
    user.username,
    userAddress.address
    FROM
    myOrder
    JOIN orderDetails ON myOrder.order_id = orderDetails.order_id
    JOIN user ON myOrder.user_id = user.user_id
    JOIN product ON orderDetails.product_id = product.product_id
    JOIN userAddress ON myOrder.user_id = userAddress.user_id
    WHERE myOrder.order_id = '$orderid';";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    //=========sql to get shipping status=================
    $statussql= "SELECT myOrder.order_id, myOrder.tracking_number, myOrder.delivery_method, orderStatus.status, orderStatus.datetime FROM myOrder JOIN orderStatus ON myOrder.order_id = orderStatus.order_id WHERE myOrder.order_id = '$orderid' ORDER BY id ASC";
    $stmt = $conn->prepare($statussql);
    $stmt->execute();
    $sresult = $stmt->get_result();

    if(isset($_POST["tracking_send"])){
        $orderid = mysqli_real_escape_string($conn, SanitizeString($_POST["order_id"]));
        $trackingnum = mysqli_real_escape_string($conn, SanitizeString($_POST["tracking_number"]));
        $status = "Shipped";
        echo $trackingnum, $status, $orderid;
        $insertsql = "INSERT INTO orderStatus (order_id, status) VALUES('$orderid', '$status')";
        $updatesql ="UPDATE myOrder SET tracking_number = '$trackingnum', order_status = '$status' WHERE order_id = '$orderid'";
         //$conn->query($insertsql);
        // $conn->query($updatesql);
        //$iquery_run = mysqli_query($conn,$insertsql);
        //$uquery_run = mysqli_query($conn,$updatesql);

        if ($conn->query($insertsql)&& $conn->query($updatesql) ) {
            $_SESSION['success'] = "Order Status has been updated";
            header("Location: ../seller/shippingCheckDetails?order_id='$orderid'.php");
            } 
        else {
          $_SESSION['status'] = "Order status update failed";
          header("Location: ../seller/shippingCheckDetails?order_id='$orderid'.php");
          }
    }
    
    if(isset($_POST["status_update"])){
        $pickupstat = mysqli_real_escape_string($conn, SanitizeString($_POST["pickup"]));
        $orderid = mysqli_real_escape_string($conn, SanitizeString($_POST["order_id"]));
        $updatesql = "INSERT INTO orderStatus (order_id, status) VALUES('$orderid', '$pickupstat')";
        
        if ($conn->query($updatesql) === TRUE) {
            $_SESSION['success'] = "Order Status has been updated";
            header("Location: ../seller/shippingCheckDetails?order_id=$orderid.php");

            } else {
          $_SESSION['status'] = "Order status update failed";
          header("Location: ../seller/shippingCheckDetails?order_id=$orderid.php");
          }
    }
?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%; font-size:14px">
<?php
    if(isset($_SESSION['success'])&& $_SESSION['success']!='')
    {
        echo '<div class="alert alert-primary" role="alert">'.$_SESSION['success'].'</div>';
        unset($_SESSION['success']); //unset value when reload
    }
    
    if(isset( $_SESSION['status'] )&&  $_SESSION['status'] )
    {
        echo '<div class="alert alert-danger" role="alert">'. $_SESSION['status'] .'</div>';
        unset( $_SESSION['status'] ); //unset value when reload
    }
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
                            <?php echo $orderid?>
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
                            <div id="recipient-name"><?php echo $username?></div>
                            <div id="recipient-address"><?php echo $address?></div>
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
                                        <th scope="col">Date</th>
                                        <th scope="col">Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php                       
                                     while ($srow = $sresult->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $srow['datetime'] ?></th>
                                        <td><?php echo $srow['status']; ?><br><?php if($srow['status'] =='Shipped'){ echo 'Tracking Number:',$srow['tracking_number'] ;}?></td>
                                    </tr>
                                <?php 
                                }
                                ?>
                                <tr>
                                <?php 
                                if ($orderstatus!='Shipped'&& $deliverymethod=='standard'){?>
                                <form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                                <td><?php echo date("Y-m-d H:i:s");?></td>
                                <td>Tracking No: <br>
                                    <input type="hidden" name="order_id" value="<?php echo $orderid?>" >
                                    <input class="form-control input" name="tracking_number" type="text" style="width:250px">
                                    <button type="submit" id="tracking_send" name="tracking_send" style="width:100px">Send</button>
                                </td>
                                </form>
                                <?php }

                                else if($orderstatus!='Ready' && $deliverymethod=='self-collection'){?>
                                <form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                                <td><?php echo date("Y-m-d H:i:s");?></td>
                                <td>Update Pick-Up Status: <br>
                                <input type="hidden" name="order_id" value="<?php echo $orderid?>" >
                                    <select id="pickup" name="pickup">
                                      <option value="Preparing"> Order is Preparing</option>
                                      <option value="Ready">Pick-Up is Ready</option>
                                      <option value="Contact">You will contact customer</option>
                                    </select>
                                    <button type="submit" id="status_update" name="status_update" style="width:100px">Update</button>
                                </td>
                                </form>
                                <?php }?>
                                </tr>
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


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
                    <?php
                    $i=0;
                    while ($row = $result->fetch_assoc()) {
                    $totalprice += $row['amount'];
                    ?>
                    <!--Start of order item-->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1"><?php echo ++$i;?>.</div>
                                <div class="col-1"><img class="card-img-top img-thumbnail" style="object-fit:contain;width:100%;height:100%" src="/img/product/<?php echo $row['product_cover_picture']?>" alt="<?php echo $row['product_name']?>" /></div>
                                <div class="col-4"><?php echo $row['product_name']?></div>
                                <div class="col-2">RM<?php echo $row['product_price']?>.00</div>
                                <div class="col-1">X<?php echo $row['quantity']?></div>
                                <div class="col-3 red-text">RM<?php echo $row['amount']?>.00</div>
                            </div>
                        </div>
                    </div>
                    <!--End of Order Item-->
                    <?php } ?>
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
                                        style="color: black;"></span>
                                    <?php echo $orderstatus?></div>
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
                                    RM<?php echo number_format($totalprice, 2)?>
                                </div>
                            </div>
                            <div class="row p-2">
                                <!--Discounts-->
                                <div class="col">
                                    Discounts:
                                </div>
                                <div class="col">
                                    -RM0.00
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
                                    <h5><strong>RM<?php echo number_format($totalprice+$shippingfee,2)?></strong></h5>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

<?php  ?>
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