<?php
require __DIR__ . '/header.php'
?>

<?php
    
    if(isset($_GET['eventID']))
    {
        $eID = $_GET['eventID'];
        $_SESSION['eventPurchaseID'] = $_GET['eventID'];
    }
?>

<title>Event Details</title>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="/css/event.css">

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
    <!-- Above Template -->

    <?php
        $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` WHERE `event`.`event_id` = $eID";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $picLocation = "/img/event/" . $row["cover_image"];
                if ($row['event_date'] == $row['eventEnd_date']) {
                    $eventDate = $row['event_date'];
                } else {
                    $eventDate = $row['event_date'] . " - " . $row['eventEnd_date'];
                }
                $eventID = $row['event_id'];
                $desc = html_entity_decode($row['description']);
                $tnc = html_entity_decode($row['event_tnc']);

                //check price
                $sql1 = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` INNER JOIN `ticketType` ON `event`.`event_id` = `ticketType`.`event_id` WHERE `event`.`event_id` = $eID";
                $result1 = mysqli_query($conn, $sql1);
                $minPrice = 999999;
                $maxPrice = 0;
                $buttonPrice = "";

                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        if ($row1['price'] >= $maxPrice) {
                            $maxPrice = $row1['price'];
                        }
                        if ($row1['price'] <= $minPrice) {
                            $minPrice = $row1['price'];
                        }
                    }
                }
                if ($maxPrice == 0) {
                    $buttonPrice = "Free";
                } else if($minPrice == $maxPrice) {
                    $buttonPrice = "RM " . $maxPrice;
                }
                else{
                    $buttonPrice = "RM " . $minPrice . " - RM " . $maxPrice;
                }

                echo ("
                <section class=\"article-clean\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-lg-10 col-xl-8 offset-lg-1 offset-xl-2\">
                            <div class=\"intro\">
                                <h1 class=\"text-center\">".$row['event_name']."</h1>
                                <p class=\"text-center\"><span class=\"by\">Organized by</span> <a href=\"#\">".$row['name']."</a></p>
                                <div class=\"row\">
                                    <div class=\"col-12\"><a href = \"selectTicket.php?eventID=" . $row['event_id'] . "\"><button class=\"btn btn-primary\" type=\"button\" style=\"background: rgb(163, 31, 55);\">Buy Ticket</button></a><button class=\"btn btn-primary\" type=\"button\" style=\"background: rgb(30,79,204);margin-left: 10px;\">Resend Ticket</button></div>
                                    <div class=\"row\">
                                        <div class=\"col col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-12\"><img style=\"width: 100%;\" src=\"$picLocation\" \"></div>
                                        <div class=\"col col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-12\">
                                            <div class=\"card\">
                                                <div class=\"card-body\">
                                                    <h4 class=\"card-title\">Event Details</h4>
                                                    <div class=\"row\">
                                                        <div class=\"col-2\" style=\"text-align: right;\"><i class=\"fa fa-calendar\"></i></div>
                                                        <div class=\"d-flex d-lg-flex align-items-end justify-content-lg-start align-items-lg-end col-10\" style=\"text-align: left;\">
                                                            <h6 class=\"text-start d-lg-flex\" style=\"margin-bottom: 0px;\">$eventDate</h6>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"col-2\" style=\"text-align: right;\"><i class=\"far fa-clock\"></i></div>
                                                        <div class=\"d-flex d-lg-flex align-items-end justify-content-lg-start align-items-lg-end col-10\" style=\"text-align: left;\">
                                                            <h6 class=\"text-start d-lg-flex\" style=\"margin-bottom: 0px;\">".$row['event_time']." to ".$row['eventEnd_time']."</h6>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"col-2\" style=\"text-align: right;\"><i class=\"far fa-flag\"></i></div>
                                                        <div class=\"d-flex d-lg-flex align-items-end justify-content-lg-start align-items-lg-end col-10\" style=\"text-align: left;\">
                                                            <h6 class=\"text-start d-lg-flex\" style=\"margin-bottom: 0px;\">".$row['category']."</h6>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"col-2\" style=\"text-align: right;\"><i class=\"far fa-money-bill-alt\"></i></div>
                                                        <div class=\"d-flex d-lg-flex align-items-end justify-content-lg-start align-items-lg-end col-10\" style=\"text-align: left;\">
                                                            <h6 class=\"text-start d-lg-flex\" style=\"margin-bottom: 0px;\">$buttonPrice</h6>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"col-2\" style=\"text-align: right;\"><i class=\"fas fa-location-arrow\"></i></div>
                                                        <div class=\"d-flex d-lg-flex align-items-end justify-content-lg-start align-items-lg-end col-10\" style=\"text-align: left;\">
                                                            <h6 class=\"text-start d-lg-flex\" style=\"margin-bottom: 0px;\">".$row['location']."</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style=\"margin-top: 16px;\">
                                        <h3>Event Description</h3>
                                        <div id=\"eventDesc-1\">$desc</div>
                                    </div>
                                    <div style=\"margin-top: 16px;\">
                                        <h3>Terms &amp; Conditions</h3>
                                        <div id=\"eventTnc\">$tnc</div>
                                    </div>
                                    <div class=\"col-12\" style=\"text-align: center;\"><a href = \"selectTicket.php?eventID=" . $row['event_id'] . "\"><button class=\"btn btn-primary\" type=\"button\" style=\"background: rgb(163, 31, 55);\">Buy Ticket</button></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                    ");
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