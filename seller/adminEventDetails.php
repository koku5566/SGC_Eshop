<?php
require __DIR__ . '/header.php'
?>

<?php

if (isset($_GET['id'])) {
    $_SESSION['eventIDView'] = $_GET['id'];

    echo $_SESSION['eventIDView'];
 $query = "SELECT ticketType.ticket_name,COUNT(*) AS cnt FROM ticketTransaction JOIN ticketType ON ticketType.ticketType_id = ticketTransaction.ticket_type_id WHERE ticketTransaction.event_id = '$eventid' GROUP BY ticketType.ticket_name ORDER BY COUNT(*) DESC ";
 $query_run = mysqli_query($conn,$query);
    
}

?>

<?php
$eID = $_SESSION['eventIDView'];
if (isset($_POST['reject'])) {
    $status = "Rejected";
    $sql = "UPDATE `event` SET `status`=? WHERE `event_id` = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "si", $status, $eID);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_affected_rows($stmt) == 1) {
            echo "<script>alert('Success!!!!!');</script>";
            //Add $_SESSION['eventID'] = "";
            //Add Redirect to next page
        } else {
            $error = mysqli_stmt_error($stmt);
            echo "<script>alert($error);</script>";
        }
        mysqli_stmt_close($stmt);
    }
} else if (isset($_POST['approve'])) {
    $status = "Approved";
    $sql = "UPDATE `event` SET `status`=? WHERE `event_id` = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "si", $status, $eID);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_affected_rows($stmt) == 1) {
            echo "<script>alert('Success!!!!!');</script>";
            //Add $_SESSION['eventID'] = "";
            //Add Redirect to next page
        } else {
            $error = mysqli_stmt_error($stmt);
            echo "<script>alert($error);</script>";
        }
        mysqli_stmt_close($stmt);
    }
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">    
  google.charts.load('current', {'packages':['bar']});
// Draw the coulumn chart when Charts is loaded.
google.charts.setOnLoadCallback(drawColChart);

function drawColChart() {

var data = google.visualization.arrayToDataTable([
    ['Ticket Type', 'Ticket Sold',],         
    <?php 
    foreach ($query_run as $row)
    {          
       echo "['" . $row['ticket_name'] . "', " . $row['cnt'] . "],";
    }
      ?>
  ]);

var options = {
   width: 800,
   legend: { position: 'none' },
   chart: {
     title: 'Tickets Sold By Ticket Type',
     subtitle: 'Ticket Number Sold' },
   axes: {
     x: {
       0: { side: 'top', label: 'Ticket Type'} // Top x-axis.
     }
   },
   bar: { groupWidth: "50%" }
 };
 var chart = new google.charts.Bar(document.getElementById('columnchart'));
 chart.draw(data, google.charts.Bar.convertOptions(options));
};
  
</script>

    <h1>Event Dashboard</h1>
    <div class="card">
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
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
                        ");

                            if ($row['status'] == "Approved" || $row['status'] == "Rejected") {
                                echo ("
                                    </form>
                                </div>
                            ");
                            } else {
                                echo ("
                                <button class=\"btn btn-secondary\" type=\"submit\" style=\"background: rgb(163, 31, 55);\" name=\"reject\">Reject</button>
                                <button class=\"btn btn-primary\" type=\"submit\" style=\"background: rgb(163, 31, 55);margin-left: 10px;\" name=\"approve\">Approve</button>
                                </form>
                            </div>
                            ");
                            }
                        }
                    }
                    ?>
                </div>
        </div>
    </div>
    <div class="card" style="margin-top: 40px;">
        <div class="card-body">
            <h4 class="card-title">Ticket Type performance</h4>
            <div id="columnchart" class="col-sm-6"style="width: 600px; height: 500px; padding-right:50px;"></div>  </body>
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
                                    echo ("
                                        <tr>
                                        <td>" . $row1['ticketOrder_id'] . "</td>
                                        <td>" . $row1['payment_id'] . "</td>
                                        <td>" . $row1['payment_status'] . "</td>
                                        <td>" . $row1['transaction_date'] . "</td>
                                        <td>" . $row1['transaction_time'] . "</td>
                                        <td>" . $row1['buyer_name'] . "</td>
                                        <td>" . $row1['buyer_contact'] . "</td>
                                        <td>" . $row1['buyer_email'] . "</td>
                                        <td>" . $row1['total_price'] . "</td>
                                        <td>" . $row1['ticket_name'] . "</td>
                                        </tr>
                                    ");
                                }
                            } else {
                                echo ("
                                        <tr>
                                        <td colspan=\"10\" style=\"text-align:center;\">No Transaction yet</td>
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
<script src="../js/eventDetails.js"></script>

<?php
require __DIR__ . '/footer.php'
?>