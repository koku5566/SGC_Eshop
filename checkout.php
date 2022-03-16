<?php
    require __DIR__ . '/header.php'
?>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">


    <div class="container-fluid" style="width:80%">
<body style="background: #f5f2f2;">
    <div class="container" style="padding: 24px;margin-top: 30px;">
        <div style="padding: 12px;background: var(--bs-body-bg);border-width: 1px;box-shadow: 0px 0px 1px var(--bs-gray-500);"><label class="form-label" style="font-size: 20px;"><i class="fa fa-map-marker" style="width: 19.4375px;"></i><strong>Delivery Address</strong></label>
            <div class="row">
                <div class="col"><label class="col-form-label" style="margin-left: 15px;">Alex yeoh</label></div>
                <div class="col offset-lg-0" style="text-align: left;"><label class="col-form-label" style="text-align: center;">018-211344</label></div>
                <div class="col"><button class="btn btn-primary text-center" type="button" style="text-align: right;background: var(--bs-pink);width: 122.95px;">Change</button></div>
            </div>
            <div class="row">
                <div class="col"><label class="col-form-label" style="margin-left: 14px;">B-11-2A, Platino, Gelugor, 11700, Pulau Pinang</label></div>
            </div>
        </div>
        <div style="padding: 12px;background: var(--bs-body-bg);border-width: 1px;box-shadow: 0px 0px 1px var(--bs-gray-500);margin-top: 15px;">
            <div></div>
            <div class="row">
                <div class="col"><label class="form-label" style="font-size: 20px;"><strong>Your Order</strong></label>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Variation</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Item Subtototal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                                <tr>
                                    <td>Product 1</td>
                                    <td>Black</td>
                                    <td>RM20</td>
                                    <td>2</td>
                                    <td>RM40</td>
                                </tr>
                                <tr>
                                    <td>Product 2</td>
                                    <td>-</td>
                                    <td>RM50</td>
                                    <td>1</td>
                                    <td>RM50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div style="margin-top: 40px;"><label class="form-label" style="margin-top: 10px;">Voucher</label>
                <div class="row">
                    <div class="col-lg-11 offset-lg-0"><input type="text" style="border-color: rgba(0,0,0,0.32);width: 240.8px;padding: 7px 2px;" placeholder="Enter voucher code"><button class="btn btn-primary text-center" type="button" style="text-align: right;background: var(--bs-pink);width: 122.95px;margin-left: 11px;">Apply</button></div>
                </div>
            </div>
            <div class="row">
                <div class="col"><label class="col-form-label" style="margin-top: 10px;">Shipping Option</label></div>
            </div>
            <div class="col">
                <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-1"><label class="form-check-label" for="formCheck-1">Standard Delivery</label></div>
                <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-2"><label class="form-check-label" for="formCheck-2">Pick-up&nbsp;</label></div>
            </div>
            <div>
                <div class="row">
                    <div class="col"><label class="form-label">Message</label>
                        <div class="row">
                            <div class="col"><input type="text" style="border-color: rgba(0,0,0,0.32);width: 240.8px;padding: 7px 2px;" placeholder="Leave a message to seller"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding: 12px;background: var(--bs-body-bg);border-width: 1px;box-shadow: 0px 0px 1px var(--bs-gray-500);margin-top: 15px;">
            <div class="row">
                <div class="col"><label class="form-label" style="font-size: 20px;"><strong>Payment Method</strong><br></label>
                    <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-3"><label class="form-check-label" for="formCheck-3">Credit/Debit Card</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-5"><label class="form-check-label" for="formCheck-5">Online Banking</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-6"><label class="form-check-label" for="formCheck-6">E-Wallet</label></div>
                    <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-4"><label class="form-check-label" for="formCheck-4">Cash on Delivery</label></div>
                </div>
                <div class="col"><label class="form-label" style="font-size: 20px;"><strong>Order Summary</strong><br></label>
                    <ul class="list-group">
                        <li class="list-group-item"><span>Order Total</span></li>
                        <li class="list-group-item"><span>Shipping Total</span></li>
                        <li class="list-group-item"><span>Total Payment</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</div>
                <!-- /.container-fluid -->

<?php
    require __DIR__ . '/footer.php'
?>