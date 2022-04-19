<?php
require __DIR__ . '/header.php'
?>

<?php

if (isset($_GET['id'])) {
    $_SESSION['eventIDView'] = $_GET['id'];
}

?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">
    <!-- Above Template -->
    <title>Event Dashboard</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/CheckOutPage-V10.css">
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

    <h1>Event Dashboard</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <?php
                $sql = "SELECT * FROM `event` WHERE `event`.`event_id` = " . $_SESSION['eventIDView'] . "";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $picLocation = "/img/event/" . $row["cover_image"];
                        echo ("
                                <div class=\"col-4\"><img src=\"$picLocation\" id=\"eventPhoto\" style=\"width: 100%;\" name=\"eventPhoto\"></div>
                                <div class=\"col-8\">
                                    <h3 name=\"eventName\">" . $row['event_name'] . "</h3>
                                    <h5>Event Status: " . $row['status'] . "</h5>
                                    <h5>Location: " . $row['location'] . "</h5>
                                    <h5>Date: " . $row['event_date'] . " to " . $row['eventEnd_date'] . "</h5>
                                    <a href = \"updateEvent.php?eventUpdate=" . $row['event_id'] . "\"><button class=\"btn btn-primary\" type=\"button\" style=\"background: rgb(163, 31, 55);\">Edit</button></a>
                                    <button class=\"btn btn-primary\" type=\"button\" style=\"background: rgb(163, 31, 55);margin-left: 10px;\">Check in Participants</button>
                                </div>
                                ");
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="card" style="margin-top: 40px;">
        <div class="card-body">
            <h4 class="card-title">Ticket Type performance</h4>
        </div>
    </div>
    <div class="card" style="margin-top: 40px;">
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
                                <th>Payment ID</th>
                                <th>Payment Status</th>
                                <th>Transaction Date</th>
                                <th>Transaction Time</th>
                                <th>Buyer Name</th>
                                <th>Buyer Contact</th>
                                <th>Buyer Email</th>
                                <th>Price</th>
                                <th>Ticket Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql1 = "SELECT * FROM `ticketTransaction` 
                            INNER JOIN `ticketType` 
                            ON  `ticketTransaction`.`ticket_type_id` = `ticketType`.`ticketType_id`
                            WHERE `ticketTransaction`.`event_id` = " . $_SESSION['eventIDView'] . "";
                            $result1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result1) > 0) {
                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                    echo("
                                        <tr>
                                        <td>".$row1['ticketOrder_id']."</td>
                                        <td>".$row1['payment_id']."</td>
                                        <td>".$row1['payment_status']."</td>
                                        <td>".$row1['transaction_date']."</td>
                                        <td>".$row1['transaction_time']."</td>
                                        <td>".$row1['buyer_name']."</td>
                                        <td>".$row1['buyer_contact']."</td>
                                        <td>".$row1['buyer_email']."</td>
                                        <td>".$row1['total_price']."</td>
                                        <td>".$row1['ticket_name']."</td>
                                        </tr>
                                    ");
                                }
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
<script src="../js/eventDetails.js"></script>

<?php
require __DIR__ . '/footer.php'
?>