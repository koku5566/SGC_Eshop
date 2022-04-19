<?php
require __DIR__ . '/header.php'
?>

<?php
    $eID = $_GET['eventID'];
?>

<title>Select Ticket</title>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="/css/event.css">

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
<!-- Above Template -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Event Ticket</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ticket Type</th>
                                    <th>Price</th>
                                    <th>Ticket ID</th>
                                    <th>Buy</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM `ticketType` WHERE `event_id` = {$_SESSION['eventPurchaseID']}";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row['sales_start'] >= date("Y-m-d") && $row['sales_end'] <= date("Y-m-d"))
                                    {
                                        echo("
                                       <tr>
                                        <td>".$row['ticket_name']."</td>
                                        <td>".$row['price']."</td>
                                        <td>".$row['ticketType_id']."</td>
                                        <td><button class=\"btn btn-primary\" type=\"button\">Buy</button></td>
                                        </tr>
                                    ");
                                    }
                                    
                                }
                            }

                        ?>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="/bootstrap/js/bootstrap.min.js"></script>

<?php
require __DIR__ . '/footer.php'
?>