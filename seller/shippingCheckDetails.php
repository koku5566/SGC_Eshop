<?php
    require __DIR__ . '/header.php'
?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%; font-size:14px">

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="order-section">
                <div class="row">
                    <div class="icon"><i class="fa fa-hashtag"></i></div>
                    <div class="title">Order ID</div>
                </div>
            </div>
            <div class="delivery-section">
                <div class="row">
                    <div class="icon"><i class="fa fa-location-dot"></i></div>
                    <div class="title">Delivery Address</div>
                </div>
                <div class="row">
                    <div class="body">
                        <div id="recipient-name">Hoe Chian Xin</div>
                        <div id="recipient-address">123252, Hello sdjkn</div>
                    </div>
                </div>
            </div>
            <div class="logistic-section">
                <div class="row">
                    <div class="icon"><i class="fa fa-truck"></i></div>
                    <div class="title">Shipping Information</div>
                </div>
                <div class="row">
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