<?php
    require __DIR__ . '/header.php'
?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
    <div class="container justify-content-center">
        <div class="row">
            <div class="date-filter col-6 mb-4" style="float:right;">
                <span style="white-space:nowrap; margin-right:10px;">Order Creation Date: </span>
                <input type="text" class="form-control" name="daterange" value="01/01/2022 - 01/15/2022" />
            </div>

            <div class="filter-search col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select class="form-control">
                            <option>Order ID</option>
                            <option>Buyer Name</option>
                            <option>Product</option>
                            <option>Tracking Number</option>
                        </select>
                    </div>
                    <input type="text" class="form-control input-text" placeholder="Search order"
                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append"> <button class="btn btn-outline-primary btn-lg" type="button"><i
                                class="fa fa-search"></i></button> </div>
                </div>
            </div>
        </div>

        <div class="order-list-panel">
            <div class="top-card card-header">
                <div class="row">
                    <div class="col-4">Product(s)</div>
                    <div class="col-2">Order Total</div>
                    <div class="col-2">Status</div>
                    <div class="col-2">All Channels</div>
                    <div class="col-2">Actions</div>
                </div>
            </div>
        </div>
        <div class="order-list-body pt-3">
            <!--Each Order Item-->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col md-auto text-start"><span>Username</span></div>
                        <div class="col md-auto text-end"><span> Order ID: 125353</span></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-1"><img src="https://www.w3schools.com/images/w3schools_green.jpg"
                                alt="W3Schools.com"></div>
                        <div class="col-2">Wireless Earphonenenenenne</div>
                        <div class="col-1">X1</div>
                        <div class="col-2">RM349.00</div>
                        <div class="col-2">Completed</div>
                        <div class="col-2">DHL eCommerce 2121113134</div>
                        <div class="col-2"><a href="#">Check details</a></div>
                    </div>
                </div>
            </div>
            <!--End of Order Item-->

        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!--Date Picker-->
<script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    //Date picker function
    $('input[name="dates"]').daterangepicker();

    $(function () {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

</script>
<?php
    require __DIR__ . '/footer.php'
?>