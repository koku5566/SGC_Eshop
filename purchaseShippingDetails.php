<?php
    require __DIR__ . '/header.php';

    $invoice_id = $_GET['invoice_id'];

    //=========sql to get order information=============
    $deliverymethod="";
    $totalprice = 0;
    $shippingfee = 8.6;
   // $ordertotal = $amt * $shippingfee;
    $orderinfosql = "SELECT
    myOrder.order_id,
    myOrder.order_status,
    myOrder.delivery_method,
    myOrder.order_date,
    myOrder.tracking_number,
    user.username,
    user.email,
    userAddress.contact_name,
    userAddress.phone_number,
    userAddress.address,
    productTransaction.quantity,
    productTransaction.shop_id,
    product.product_name,
    product.product_price,
    product.product_cover_picture,
    shopProfile.shop_name,
    shopProfile.shop_profile_image,
    shopProfile.shop_id,
    shopProfile.shop_address_state,
    FROM
    myOrder
    JOIN user ON myOrder.userID = user.user_id
    JOIN userAddress ON myOrder.userID = userAddress.user_id
    JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id
    JOIN product ON productTransaction.product_id = product.product_id
    JOIN shopProfile ON productTransaction.shop_id = shopProfile.shop_id
    WHERE myOrder.invoice_id =  '$invoice_id';";
    $stmt = $conn->prepare($orderinfosql);
    $stmt->execute();
    $oresult = $stmt->get_result();
    while ($orow = $oresult->fetch_assoc()) {
        $orderid = $orow['order_id'];
        $orderstatus = $orow['order_status'];
        $deliverymethod = $orow['delivery_method'];
        $username = $orow['username'];
        $contactname = $orow['contact_name'];
        $phone = $orow['phone_number'];
        $buyeremail = $orow['email'];
        $address = $orow['address'];
        $trackingnum = $orow['tracking_number'];
        $orderdate = $orow['order_date'];
        $qty = $orow['quantity'];
        $productname = $orow['product_name'];
        $productprice = $orow['product_price'];
        $productcover = $orow['product_cover_picture'];
        $shopname = $orow['shop_name'];
        $shopprofile = $orow['shop_profile_image'];
        $shopid = $orow['shop_id'];
        $shopaddress= $orow['shop_address_state'];
    }
    $orderdate = strtotime($orderdate);
    $estimateddelivery = strtotime('+7 day',$orderdate); 

    //======to get seller email ==============================
    $selleremailsql =" SELECT email FROM user WHERE user_id = '$shopid'";
    $stmt = $conn->prepare($selleremailsql);
    $stmt->execute();
    $selleremailresult = $stmt->get_result();
    while ($sEmailrow = $selleremailresult->fetch_assoc()) {
        $selleremail = $sEmailrow['email'];
    }

    //=========sql to get shipping status=================
    $statussql= "SELECT myOrder.order_id, myOrder.invoice_id, myOrder.tracking_number, myOrder.delivery_method, orderStatus.status, orderStatus.datetime FROM myOrder JOIN orderStatus ON myOrder.invoice_id = orderStatus.invoice_id WHERE myOrder.invoice_id = '$invoice_id' ORDER BY order_id ASC";
    $stmt = $conn->prepare($statussql);
    $stmt->execute();
    $sresult = $stmt->get_result();

    //complete pick up
    if(isset($_POST["completeBtn"])){
        $orderid = mysqli_real_escape_string($conn, SanitizeString($_POST["order_id"]));
        $invoice_id = mysqli_real_escape_string($conn, SanitizeString($_POST["invoice_id"]));
        $status = "Completed";
        $insertsql = "INSERT INTO orderStatus (order_id,invoice_id, status) VALUES('$orderid','$invoice_id', '$status')";
        $updatesql = "UPDATE myOrder SET order_status = '$status' WHERE invoice_id = '$invoice_id'";

        if ($conn->query($insertsql)&& $conn->query($updatesql)) {
            $_SESSION['success'] = "Thank you for updating!";?>
            <script>window.location = 'purchaseShippingDetails.php?invoice_id=<?php echo $invoice_id;?>'</script>
            <?php
           // header("Location:purchaseShippingDetails.php?order_id=".$orderid);
            } else {
          $_SESSION['status'] = "Order status update failed";?>
           <script>window.location = 'purchaseShippingDetails.php?invoice_id=<?php echo $invoice_id;?>'</script>
          <?php
        }
    }
        //order received
        if(isset($_POST["receivedBtn"])){
            $orderid = mysqli_real_escape_string($conn, SanitizeString($_POST["order_id"]));
            $invoice_id = mysqli_real_escape_string($conn, SanitizeString($_POST["invoice_id"]));
            $status = "Delivered";
            $insertsql = "INSERT INTO orderStatus (order_id,invoice_id, status) VALUES('$orderid','$invoice_id', '$status')";
            $updatesql = "UPDATE myOrder SET order_status = '$status' WHERE invoice_id = '$invoice_id'";
        
            if ($conn->query($insertsql)&& $conn->query($updatesql)) {
                $_SESSION['success'] = "Thank you for updating!";?>
                <script>window.location = 'purchaseShippingDetails.php?invoice_id=<?php echo $invoice_id;?>'</script>
                <?php
               // header("Location:purchaseShippingDetails.php?order_id=".$orderid);
                } else {
              $_SESSION['status'] = "Order status update failed";?>
               <script>window.location = 'purchaseShippingDetails.php?invoice_id=<?php echo $invoice_id;?>'</script>
              <?php
            }
        }

    //pick up status update
    if(isset($_POST["remind_seller"])){
        $buyer_email = mysqli_real_escape_string($conn, SanitizeString($_POST["buyeremail"]));
        $seller_email = mysqli_real_escape_string($conn, SanitizeString($_POST["selleremail"]));
        $invoice_id = mysqli_real_escape_string($conn, SanitizeString($_POST["invoice_id"]));

        //echo $buyer_email,$seller_email;
        $to = $seller_email;
        $subject = "Remind to Ship for Order Number: '$invoice_id'" ;
        $from = "shipping@sgcprototype2.com";
        $from2 = "shipping@sgcprototype2.com";
        $fromName = "SGC E-Shop Admin";

        $headers =  "From: $fromName <$from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed;\r\n";


        $message = "
        <h5>Remember to ship order items for '$invoice_id'</h5>
        <p>Your customer has notify you that the  order has not been shipped yet. Please kindly ship all order items to keep a good rating for your shop. :)
        <h4>Thank you</h4>
        <h4>Best Regards</h4>
        <h4>SGC Eshop</h4>
        ";

        $HTMLcontent = "<p><b>Dear seller</b>,</p><p>$message</p>";

        $boundary = md5(time());
        $headers .= " boundary=\"{$boundary}\"";
        $message = "--{$boundary}\r\n";
        $message .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
        $message .= "Content-Transfer-Encoding: 7bit\r\n";
        $message .= $HTMLcontent . "\r\n";
        $message .= "--{$boundary}\r\n";
        $returnPath = "-f" . $from2;

        if (@mail($to, $subject, $message, $headers, $returnPath)) {
            echo "<script>alert('A notification email has been sent to the seller')</script>";
        } else {
            echo "<script>alert('Error')</script>";
        }
        
    }
?>

<input type="hidden" id="orderstatus" value="<?php echo $orderstatus; ?>">
<input type="hidden" id="deliverymethod" value="<?php echo $deliverymethod; ?>">

<!-- Begin Page Content -->
<div class="container-fluid mb-3" style="width:80%; margin-bottom:50px;">

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
    <!--Horizontal Order Tracking Status-->
    <div class="card shadow mb-3">
    <div class="p-4 text-center text-white text-lg bg-dark rounded-top">
        <span class="text-uppercase">
        <?php if($deliverymethod =='self-collection'):?>
        PICK UP ORDER
        <?php  else :?>
        Tracking No - </span><span class="text-size-medium"><?php echo $trackingnum?></span>
        <?php endif; ?>
        </div>      
        <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
            <div class="w-100 text-center py-1 px-2"><span class="text-size-medium">Order ID:</span><?php echo $invoice_id?></div>
            <div class="w-100 text-center py-1 px-2"><span class="text-size-medium">Status:</span> Order <?php echo ' ',$orderstatus ?></div>
            <div class="w-100 text-center py-1 px-2"><span class="text-size-medium">Expected Date:</span><?php echo date("Y-m-d",$estimateddelivery)?></div>
        </div>
        <div class="card-body">
            <!---------FOR standard-delivery SHIPPING STATUS------------->
            <?php if($deliverymethod == 'standard-delivery'){?>
            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                <div class="step" id="placed">
                    <div class="step-icon-wrap">
                        <div class="step-icon "><i class="fa fa-cart-shopping"></i></div>
                    </div>
                    <h5 class="step-title">Order Placed</h5>
                </div>
                <div class="step" id="paid">
                    <div class="step-icon-wrap">
                        <div class="step-icon "><i class="fa fa-receipt"></i></div>
                    </div>
                    <h5 class="step-title">Order Paid</h5>
                </div>
                <div class="step" id="shipped">
                    <div class="step-icon-wrap">
                        <div class="step-icon"><i class="fa fa-truck"></i></div>
                    </div>
                    <h5 class="step-title">Order Shipped Out</h5>
                </div>
                <div class="step" id="delivered">
                    <div class="step-icon-wrap" >
                        <div class="step-icon "><i class="fa fa-house"></i></div>
                    </div>
                    <h5 class="step-title">Order Delivered</h5>
                </div>
            </div>
            <?php } else{?>
            <!------------ FOR PICK UP( SELF-COLLECTION) STATUS --------->
            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                <div class="step" id="pplaced">
                    <div class="step-icon-wrap">
                        <div class="step-icon "><i class="fa fa-cart-shopping"></i></div>
                    </div>
                    <h5 class="step-title">Order Placed</h5>
                </div>
                <div class="step" id="ppaid">
                    <div class="step-icon-wrap">
                        <div class="step-icon "><i class="fa fa-receipt"></i></div>
                    </div>
                    <h5 class="step-title">Order Paid</h5>
                </div>
                <div class="step" id="pready">
                    <div class="step-icon-wrap">
                        <div class="step-icon"><i class="fa fa-box"></i></div>
                    </div>
                    <h5 class="step-title">Ready To Pick Up</h5>
                </div>
                <div class="step" id="pcompleted">
                    <div class="step-icon-wrap" >
                        <div class="step-icon "><i class="fa fa-clipboard-check"></i></div>
                    </div>
                    <h5 class="step-title">Order Completed</h5>
                </div>
            </div>
            <?php }?>
            <hr>
            <!--Delivery Details-->
            <div class="delivery-details pl-2">
                <div class="row">
                    <strong>Delivery Details </strong>
                </div>
                <div class="row">
                    <div id="recepient-name"> </div><?php echo $phone ?><br>
                    <div id="address"><?php echo $address?> </div>
                </div>
            </div>
            <hr>
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
                 <?php if($srow['status']=='Ready' && $orderstatus =='Ready'){?> <tr class="table-success"><?php } else if ($srow['status'] =='Failed' && $orderstatus =='Failed'){?> <{?><tr class="table-danger"> <?php }  else { ?><tr> <?php } ?>  <!-- if pick up order is ready, set row to green colour-->
                        <td><?php echo $srow['datetime'] ?></th>
                        <td>Order<?php echo ' ', $srow['status']; ?><br><?php if($srow['status'] =='Shipped'){ echo 'Tracking Number: ',$srow['tracking_number'] ;?><input type="hidden" id="TrackNo" value="<?php echo $srow['tracking_number'];?>"><br><button class="btn btn-info btn-sm" onclick="linkTrack()">TRACK</button><?php } else if($srow['status'] =='Ready'){?> Please pick up at following address: <?php echo $shopaddress; }?></td>
                    </tr>
                <?php 
                }
                ?>
                </tbody>
            </table>

            <?php 
            //calculate how many days passed since order date
            $now = date('Y-m-d'); 
            $today = strtotime($now);
            $datediff = $today - $orderdate;
            $days=  round($datediff / (60 * 60 * 24));
            
            //Remind seller function is available if seller did not ship out item for 5 days
            if($orderstatus =='Paid'&& $days >=5 ){?>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" >
                    <input type="text" name="buyeremail" value="<?php echo $buyeremail; ?>">
                    <input type="text" name="selleremail" value="<?php echo $selleremail?>">
                    <input type="text" name="invoice_id" value="<?php echo $invoice_id?>">
                    <button type="submit" name="remind_seller" class="btn btn-primary">Remind Seller</button>
                    </form>
                <?php }else if ($orderstatus == 'Paid' && $days <5) {?>

                        <button class="btn btn-primary" type="button" disabled> Remind Seller to ship </button>
                        <span style="color: grey"> <small>You can remind seller if order has not been shipped after 5 days</small><span>
                    <?php
                 }?>

                <?php if($orderstatus =='Ready'){?>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" >
                    <input type="hidden" name="order_id" value="<?php echo $orderid; ?>">
                    <input type="hidden" name="invoice_id" value="<?php echo $invoice_id?>">
                    <button type="submit" name="completeBtn" class="btn btn-primary">Pick Up Completed</button>
                    </form>
                <?php } ?>

                <?php if($orderstatus =='Shipped'){?>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" >
                    <input type="hidden" name="order_id" value="<?php echo $orderid; ?>">
                    <input type="hidden" name="invoice_id" value="<?php echo $invoice_id?>">
                    <button type="submit" name="receivedBtn" class="btn btn-primary">Order Received</button>
                    </form>
                <?php } ?>
            
        </div>
    </div>

    <!---$qty = $orow['quantity'];
        $amt = $orow['amount'];
        $productname = $orow['product_name'];
        $productcover = $orow['product_cover_picture'];ref
        $shopname = $orow['shop_name'];
        $shopprofile = $orow['shop_profile_image'];-->

    <!--Order Details-->

</div>
<!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>
<script src="//www.tracking.my/track-button.js"></script>
<script>
  function linkTrack() {
    var num = document.getElementById("TrackNo").value;
    console.log(num);
    TrackButton.track({
      tracking_no: num
    });
  }

</script>

<style>
    body {
        margin-top: 20px;
        font-size: 14px;
        margin-bottom: 20%;
    }


    .steps .step {
        display: block;
        width: 100%;
        margin-bottom: 35px;
        text-align: center
    }

    .steps .step .step-icon-wrap {
        display: block;
        position: relative;
        width: 100%;
        height: 80px;
        text-align: center
    }

    .steps .step .step-icon-wrap::before,
    .steps .step .step-icon-wrap::after {
        /* the progress line*/
        display: block;
        position: absolute;
        top: 50%;
        width: 50%;
        height: 3px;
        margin-top: -1px;
        background-color: #e1e7ec;
        content: '';
        z-index: 1
    }

    .steps .step .step-icon-wrap::before {
        /* no spacing in left side progress line*/
        left: 0
    }

    .steps .step .step-icon-wrap::after {
        /* no spacing in right side progress line*/
        right: 0
    }

    .steps .step .step-icon {
        /*Step not completed*/
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        border: 1px solid #e1e7ec;
        border-radius: 50%;
        background-color: #f5f5f5;
        color: #374250;
        font-size: 38px;
        line-height: 81px;
        z-index: 5
    }

    .steps .step .step-title {
        margin-top: 16px;
        margin-bottom: 0;
        color: #606975;
        /*font-size: 14px;
    font-weight: 500*/
    }

    .steps .step:first-child .step-icon-wrap::before {
        /* remove first icon left side line*/
        display: none
    }

    .steps .step:last-child .step-icon-wrap::after {
        /* remove first icon right side line*/
        display: none
    }

    .steps .step.completed .step-icon-wrap::before,
    .steps .step.completed .step-icon-wrap::after {
        background-color: #0da9ef
    }

    .steps .step.completed .step-icon {
        /*step completed*/
        border-color: #0da9ef;
        background-color: #0da9ef;
        color: #fff
    }

    @media (max-width: 576px) {

        .flex-sm-nowrap .step .step-icon-wrap::before,
        .flex-sm-nowrap .step .step-icon-wrap::after {
            display: none
        }
    }

    @media (max-width: 768px) {

        .flex-md-nowrap .step .step-icon-wrap::before,
        .flex-md-nowrap .step .step-icon-wrap::after {
            display: none
        }
    }

    @media (max-width: 991px) {

        .flex-lg-nowrap .step .step-icon-wrap::before,
        .flex-lg-nowrap .step .step-icon-wrap::after {
            display: none
        }
    }

    @media (max-width: 1200px) {

        .flex-xl-nowrap .step .step-icon-wrap::before,
        .flex-xl-nowrap .step .step-icon-wrap::after {
            display: none
        }
    }

    .bg-faded,
    .bg-secondary {
        background-color: #f5f5f5 !important;
    }

    /*Verticle progress bar*/
    .card0 {
        background-color: #F5F5F5;
        border-radius: 8px;
        z-index: 0
    }

    .card00 {
        z-index: 0
    }

    .card1 {
        margin-left: 140px;
        z-index: 0;
        border-right: 1px solid #F5F5F5
    }

    .card2 {
        display: none
    }

    .card2.show {
        display: block
    }

    #progressbar {
        position: relative;
        left: 35px;
        overflow: hidden;
        color: #E53935
    }

    #progressbar li {
        list-style-type: none;

        font-weight: 400;
        margin-bottom: 36px
    }

    #progressbar li:nth-child(3) {
        margin-bottom: 88px
    }

    #progressbar .step0:before {
        content: "";
        color: #fff
    }

    #progressbar li:before {
        width: 30px;
        height: 30px;
        line-height: 30px;
        display: block;
        background: #fff;
        border: 2px solid #E53935;
        border-radius: 50%;
    }

    #progressbar li:last-child:before {
        width: 40px;
        height: 40px
    }

    #progressbar li:after {
        content: '';
        width: 3px;
        height: 66px;
        background: #BDBDBD;
        position: absolute;
        z-index: -1
    }

    #progressbar li:last-child:after {
        top: 147px;
        height: 132px
    }

    #progressbar li:nth-child(3):after {
        top: 81px
    }

    #progressbar li:nth-child(2):after {
        top: 0px
    }

    #progressbar li:first-child:after {
        position: absolute;
        top: -81px
    }

    #progressbar li.active:after {
        background: #E53935
    }

    #progressbar li.active:before {
        background: #E53935;
        font-family: FontAwesome;
        content: "\f00c"
    }

    .tick {
        width: 100px;
        height: 100px
    }

    .red-text {
        color: #A71337;
        font-weight: bold;
    }

    .text-size-medium{
        font-size:18px;
    }
    .prev:hover {
        color: #D50000 !important
    }

    @media screen and (max-width: 912px) {
        .card00 {
            padding-top: 30px
        }

        .card1 {
            border: none;
            margin-left: 50px
        }

        .card2 {
            border-bottom: 1px solid #F5F5F5;
            margin-bottom: 25px
        }
    }

    .track-shipping tr:first-child td {
    color: green;
    }
    .tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>

<script>
var orderstatus = document.getElementById("orderstatus").value;
var deliverymethod = document.getElementById("deliverymethod").value;

console.log(orderstatus);
if (deliverymethod == "standard-delivery") {
    if(orderstatus == 'Placed')
    {
        document.getElementById("placed").className ="step completed";
    }
    else if(orderstatus == 'Paid')
    {
        document.getElementById("placed").className ="step completed";
        document.getElementById("paid").className ="step completed";
    }
    else if(orderstatus == 'Shipped')
    {
        console.log('can work');
        document.getElementById("placed").className ="step completed";
        document.getElementById("paid").className ="step completed";
        document.getElementById("shipped").className ="step completed";
    }
    else if(orderstatus == 'Delivered')
    {
        document.getElementById("placed").className ="step completed";
        document.getElementById("paid").className = "step completed";
        document.getElementById("shipped").className ="step completed";
        document.getElementById("delivered").className ="step completed";
    }
}
else{
    if(orderstatus == 'Placed')
    {
        document.getElementById("pplaced").className ="step completed";
    }
    else if(orderstatus == 'Paid')
    {
        document.getElementById("pplaced").className ="step completed";
        document.getElementById("ppaid").className ="step completed";
    }
    else if(orderstatus == 'Ready')
    {
        document.getElementById("pplaced").className ="step completed";
        document.getElementById("ppaid").className ="step completed";
        document.getElementById("ppreparing").className ="step completed";
    }
    else if(orderstatus == 'Completed')
    {
        document.getElementById("pplaced").className ="step completed";
        document.getElementById("ppaid").className = "step completed";
        document.getElementById("pready").className ="step completed";
        document.getElementById("pcompleted").className ="step completed";
    }
}
</script>