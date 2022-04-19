<?php
require __DIR__ . '/header.php'
?>

<?php
$ticket = $_SESSION['ticketSelected'];
$eID =  $_SESSION['eventPurchaseID'];
$formRecord = $_SESSION['formEntry'];
?>

<title>Register Participant</title>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="/css/event.css">

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
    <!-- Above Template -->

    <h1 class="text-center">Event Checkout</h1>
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Buyer Details</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <div><label class="form-label">Buyer Name</label><input class="form-control" type="text" placeholder="Buyer Name" name="buyerName"></div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-6"><label class="form-label">Email</label><input class="form-control" type="email" placeholder="Email" name="buyerEmail"></div>
                            <div class="col-6"><label class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">+6</span></div><input class="form-control" type="tel" placeholder="012xxxxxxx" name="buyerContact">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
            <div class="card">
                <div class="card-header" style="background: rgb(163, 31, 55);">
                    <h5 class="mb-0" style="color: rgb(255,255,255);">Checkout Summary</h5>
                </div>
                <?php
                    $sql = "SELECT * FROM `event` 
                    INNER JOIN `ticketType` 
                    ON `event`.`event_id` = `ticketType`.`event_id` 
                    INNER JOIN `user`
                    ON `event`.`organiser_id` = `user`.`user_id`
                    WHERE `ticketType`.`ticketType_id` = $ticket";
                    $result = mysqli_query($conn, $sql);
    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['event_date'] == $row['eventEnd_date']) {
                                $eventDate = $row['event_date'];
                            } else {
                                $eventDate = $row['event_date'] . " - " . $row['eventEnd_date'];
                            }
                            echo("
                            <div class=\"card-body\">
                            <h6 class=\"text-muted card-subtitle mb-2\" style=\"font-size: 20px;\">".$row['event_name']."</h6>
                            <h6 class=\"text-muted card-subtitle mb-2\">".$row['name']."</h6>
                            <div class=\"row\">
                                <div class=\"col-4\">
                                    <p>Event Date:&nbsp;</p>
                                </div>
                                <div class=\"col-8\">
                                    <p>$eventDate</p>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"col-4\">
                                    <p>Ticket:</p>
                                </div>
                                <div class=\"col-8\">
                                    <p>".$row['ticket_name']."</p>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"col-4\">
                                    <p>Price:&nbsp;</p>
                                </div>
                                <div class=\"col-8\">
                                    <p>".$row['price']."</p>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                            ");

                            if($row['price'] == 0)
                            {
                                echo("
                                <div class=\"row\">
                                <div class=\"col\" style=\"text-align: center;\"><button class=\"btn btn-secondary\" type=\"button\">Back</button><button class=\"btn btn-primary\" type=\"submit\" style=\"background: rgb(163, 31, 55); margin-left:5px;\">Register</button></div>
                                </div> 
                                ");
                            }
                            else
                            {
                                echo("
                                <div class=\"row\">
                                <div class=\"col\" style=\"text-align: center;\"><button class=\"btn btn-secondary\" type=\"button\">Back</button><button class=\"btn btn-primary\" type=\"submit\" style=\"background: rgb(163, 31, 55); margin-left:5px;\">Payment</button></div>
                                </div>
                                ");
                            }

                        }
                    }

                ?>
                
            
    


    <!-- Below Template -->
</div>
<!-- /.container-fluid -->

<script src="/bootstrap/js/bootstrap.min.js"></script>

<?php
require __DIR__ . '/footer.php'
?>