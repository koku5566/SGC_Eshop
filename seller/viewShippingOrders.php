<?php
    require __DIR__ . '/header.php'
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
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-12" style="padding-bottom: .625rem;">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <select class="form-select" name="searchBy" aria-label="SearchBy"
                                        style="color:currentColor;">
                                        <option selected value="id">Order ID</option>
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
                                <input type="text" class="form-control" name="daterange"
                                    value="01/01/2022 - 01/15/2022" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 col-lg-8 col-sm-4" style="padding-bottom: .625rem;">

                        </div>
                        <div class="col-xl-1 col-lg-2 col-sm-4" style="padding-bottom: .625rem;">
                            <button type="button" class="btn btn-primary">Search</button>
                        </div>
                        <div class="col-xl-1 col-lg-2 col-sm-4" style="padding-bottom: .625rem;">
                            <button type="button" class="btn btn-outline-dark">Reset</button>
                        </div>

                    </div>
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
                        <!--------------------------------All-------------------------------------->

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
                            <div class="tab-pane active fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <!--Each Order Item-->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col md-auto text-start"><span><strong>Username</strong></span>
                                            </div>
                                            <div class="col md-auto text-end" style="text-align:right;"><span><strong>
                                                        Order
                                                        ID:
                                                        125353</strong></span></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-1"><img width="100%"
                                                    src="https://www.w3schools.com/images/w3schools_green.jpg"
                                                    alt="W3Schools.com"></div>
                                            <div class="col-3">Wireless Earphone dfdfbdfbd</div>
                                            <div class="col-1">X1</div>

                                            <div class="col-1">RM349.00</div>
                                            <div class="col-2">Completed</div>
                                            <div class="col-2">DHL eCommerce 2121113134</div>
                                            <div class="col-2"><a href="shippingCheckDetails.php">Check details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Order Item-->

                            </div>
                            <!--------------------------------To ship--------------------------------------->
                            <div class="tab-pane fade" id="toship" role="tabpanel" aria-labelledby="toship-tab">
                                <!--Pills tab--->
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

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