<?php
require __DIR__ . '/header.php'
?>

<?php
/*     if($_SESSION['login'] == false || $_SESSION['role'] == "ADMIN")
	{
		?><script>window.location = '<?php echo("$domain/index.php");?>'</script><?php
		exit;
    } */
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Select datatable CSS-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

    <!-- Select datatable JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <h1>Order Shipping History</h1>
    <div class="card">
  <!--       <div class="card-body">
    <div class="card" style="margin-top: 40px;"> -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h4>Order List</h4>
                </div>
            </div>
            <div class="row" style="margin-top:20px">
                <div class="col-12">
                    <table id="shippingOrderTable">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Invoice ID</th>
                                <th>Seller ID</th>
                                <th>Buyer ID</th>
                                <th>Delivery Method</th>
                                <th>Order Status</th>
                                <th>Track</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT * FROM myOrder JOIN productTransaction ON myOrder.invoice_id = productTransaction.invoice_id";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {?>
                                        <tr>
                                        <td><?php echo $row['order_date']?></td>
                                        <td><?php echo $row['invoice_id']?></td>
                                        <td><?php echo $row['shop_id']?></td>
                                        <td><?php echo $row['userID']?></td>
                                        <td><?php echo $row['delivery_method']?></td>
                                        <td><?php echo $row['order_status']?></td>
                                        <td><input type="hidden" id="TrackNo" value="<?php echo $srow['tracking_number'];?>"><button class="btn btn-info btn-sm" onclick="linkTrack()">TRACK</button></td>
                                        </tr>
                                    <?php 
                                }
                            }
                            else
                            {
                                echo("
                                        <tr>
                                        <td colspan=\"10\" style=\"text-align:center;\">Shipping Order is empty</td>
                                        </tr>
                                ");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Below Template -->
</div>
<!-- /.container-fluid -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="//www.tracking.my/track-button.js"></script>

<script>
function linkTrack() {
    var num = document.getElementById("TrackNo").value;
    console.log(num);
    TrackButton.track({
      tracking_no: num
    });
  }

var t = $('#shippingOrderTable').DataTable({//call table id
    dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Transaction List'
            },
            {
                extend: 'pdfHtml5',
                title: 'Transaction List'
            },
            {
                extend: 'csvHtml5',
                title: 'Transaction List'
            },
        ]
});


</script>

<?php
require __DIR__ . '/footer.php'
?>