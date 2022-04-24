<?php
require __DIR__ . '/header.php'
?>

<?php
    if($_SESSION['login'] == false || $_SESSION['role'] == "USER")
	{
		?><script>window.location = '<?php echo("$domain/index.php");?>'</script><?php
		exit;
    }
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

    <h1>Transaction History</h1>
    <div class="card">
  <!--       <div class="card-body">
    <div class="card" style="margin-top: 40px;"> -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h4>Transaction List</h4>
                </div>
            </div>
            <div class="row" style="margin-top:20px">
                <div class="col-12">
                    <table id="transactionTable">
                        <thead>
                            <!-- replace with proper value -->
                            <tr>
                                <th>Transaction ID</th>
                                <th>Invoice ID</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Payment Amount</th>
                                <th>Transaction Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sqlpayment = "SELECT  * FROM `payments` INNER JOIN (SELECT invoice_id, shop_id FROM productTransaction GROUP BY invoice_id, shop_id)t on payments.invoice_id = t.invoice_id WHERE t.shop_id = '$_SESSION[userid]' ";
                            $result1 = mysqli_query($conn, $sqlpayment);
                            if (mysqli_num_rows($result1) > 0) {
                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                    echo("
                                        <tr>
                                        <td>".$row1['transaction_id']."</td>
                                        <td>".$row1['invoice_id']."</td>
                                        <td>".$row1['product_id']."</td>
                                        <td>".$row1['product_name']."</td>
                                        <td>".$row1['payment_amount']."</td>
                                        <td>".$row1['createdtime']."</td>
                                        </tr>
                                    ");
                                }
                            }
                            else
                            {
                                echo("
                                        <tr>
                                        <td colspan=\"10\" style=\"text-align:center;\">Transaction is empty</td>
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
<script>
var t = $('#transactionTable').DataTable({//call table id
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