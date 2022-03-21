<?php
    require __DIR__ . '/header.php'
?>

<!-- Begin Page Content -->
<div class="container-fluid mb-3" style="width:80%; margin-bottom:50px;">
    <!--Horizontal Order Tracking Status-->
    <div class="card mb-3">
        <div class="p-4 text-center text-white text-lg bg-dark rounded-top"><span class="text-uppercase">Tracking Order No - </span><span class="text-size-medium">34VB5540K83</span></div>
        <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
            <div class="w-100 text-center py-1 px-2"><span class="text-size-medium">Shipped Via:</span>DHL</div>
            <div class="w-100 text-center py-1 px-2"><span class="text-size-medium">Status:</span> Processing Order</div>
            <div class="w-100 text-center py-1 px-2"><span class="text-size-medium">Expected Date:</span> SEP 09, 2017</div>
        </div>
        <div class="card-body">
            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                <div class="step completed">
                    <div class="step-icon-wrap">
                        <div class="step-icon "><i class="fa fa-cart-shopping"></i></div>
                    </div>
                    <h5 class="step-title">Confirmed Order</h5>
                </div>
                <div class="step completed">
                    <div class="step-icon-wrap">
                        <div class="step-icon "><i class="fa fa-box"></i></div>
                    </div>
                    <h5 class="step-title">Processing Order</h5>
                </div>
                <div class="step">
                    <div class="step-icon-wrap">
                        <div class="step-icon"><i class="fa fa-truck"></i></div>
                    </div>
                    <h5 class="step-title">Product Dispatched</h5>
                </div>
                <div class="step">
                    <div class="step-icon-wrap">
                        <div class="step-icon "><i class="fa fa-house"></i></div>
                    </div>
                    <h5 class="step-title">Product Delivered</h5>
                </div>
            </div>
            <hr>
            <!--Delivery Details-->
            <div class="delivery-details pl-2">
                <div class="row">
                    <strong>Delivery Details </strong>
                </div>
                <div class="row">
                    <div id="recepient-name">Yee YingYing</div>（+60）1117795416<br>
                    <div id="address">9-13-9， Sri Impian Apartment, Lengkok Angsana, 11500 Ayer Itam, Pulau Pinang </div>
                </div>
            </div>
            <hr>
            <!--Shipping Progress table-->
            <table class="table track-shipping">
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

    <!--Order Details-->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <div class="text-start p-1"><small>Purchased Date & Time</small></div>
                <div class="row">
                    <div class="col-8">
                        <!--Shop Logo & Name-->
                        <span><img src="https://www.w3schools.com/images/w3schools_green.jpg" alt="W3Schools.com"
                                width="40" height="40"></span>
                        <span><strong>| SEGi College Subang Jaya</strong></span>
                    </div>
                    <div class="col-4 text-right">
                        <!--Purchase Date and Time-->
                        <div class="text-end pt-2">
                            04 Sep 2021 | 04:45 p.m.
                            </span>
                        </div>
                    </div>
            </h5>
        </div>
        <div class="card-body">
            <!--Ordered Items-->
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td scope="row"><img src="https://www.w3schools.com/images/w3schools_green.jpg"
                                alt="W3Schools.com"></td>
                        <td>3-in-1 Power Bank with Phone Stand Model: WI-SP510</td>
                        <td>Navy blue</td>
                        <td>RM34.00</td>
                        <td>x1</td>
                        <td class="red-text">rm349.00</td>
                    </tr>
                    <tr>
                        <td scope="row"><img src="https://www.w3schools.com/images/w3schools_green.jpg"
                                alt="W3Schools.com"></td>
                        <td>3-in-1 Powe</td>
                        <td>Navy blue</td>
                        <td>RM34.00</td>
                        <td>x1</td>
                        <td class="red-text">rm349.00</td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="row">
                <!--Payment method & Status-->
                <div class="col-8">
                    <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2">
                        <div class="w-100 text-start"><span class="text-size-medium p-2"><strong> Payment
                                    Method:</strong></span><span class="iconify" data-icon="bi:credit-card"
                                style="color: black; width: 30px;height:30px"></span><span class="p-2">Credit
                                Card</span> </div>
                        <div class="w-100 text-start"><span class="text-size-medium"><strong>Status:</strong></span> <span
                                class="iconify" data-icon="carbon:delivery" style="color: black;"></span>Processing
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
<!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>

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
</style>