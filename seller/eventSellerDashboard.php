<?php
    require __DIR__ . '/header.php'
?>

    <!-- Begin Page Content -->
    <div class="container-fluid" style="width:100%;">
    <!-- Above Template -->
    <title>Event Dashboard</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/CheckOutPage-V10.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    
    <div style="margin-left: 80px;margin-right: 80px;height: 181.8px;">
        <div class="text-end" style="margin-top: 20px; text-align:right;"><a href="https://eshop.sgcprototype2.com/seller/createEvent.php"><button class="btn btn-primary" id="createEventBtn" type="button" style="background: rgb(163, 31, 55);width: 121.75px;height: 47px;">Create Event</button></a></div>
        <h4>Search</h4><input type="search" style="width: 100%;">
        <div>
            <div class="btn-group float-end" role="group" style="margin-top: 7px;"><button class="btn btn-primary" type="button" style="margin-right: 0px;margin-left: 10px;">Reset</button><button class="btn btn-primary" type="button" style="margin-right: 0px;margin-left: 10px;background: rgb(163, 31, 55);">Search</button></div>
        </div>
    </div>
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1">All</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">Up Coming</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-3">Past</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="tab-1">
                <div style="margin-left: 80px;margin-right: 80px;">
                    <?php
                        $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` WHERE `organiser_id` = 1";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $eventID = $row['event_id'];
                                $sql1 = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` INNER JOIN `ticketType` ON `event`.`event_id` = `ticketType`.`event_id` WHERE `event`.`event_id` = $eventID";
                                $result1 = mysqli_query($conn, $sql1);
                                $minPrice = 999999;
                                $maxPrice = 0;
                                $buttonPrice = "";

                                if (mysqli_num_rows($result1) > 0) {
                                    while($row1 = mysqli_fetch_assoc($result1)) {
                                        if($row1['price'] >= $maxPrice)
                                        {
                                            $maxPrice = $row1['price'];
                                        }
                                        if($row1['price'] <= $minPrice)
                                        {
                                            $minPrice = $row1['price'];
                                        }
                                    
                                    }
                                }
                                if($maxPrice == 0)
                                {
                                    $buttonPrice = "Free";
                                }
                                else
                                {
                                    $buttonPrice = "RM ".$minPrice . " - RM " . $maxPrice;
                                }
                                echo("
                                    <div class=\"card\" style=\"margin-top: 20px;\">
                                        <div class=\"card-body shadow\">
                                            <h4 class=\"card-title\">".$row['event_name']."</h4>
                                            <h6 class=\"text-muted card-subtitle mb-2\">".$row['status']."</h6>
                                            <h5>Date: ".$row['event_date']." - ".$row['eventEnd_date']."</h5>
                                            <h5>Price: $buttonPrice</h5><button class=\"btn btn-primary float-end\" type=\"button\" style=\"background: rgb(163, 31, 55);width: 164.5px;\">Dashboard</button>
                                        </div>
                                    </div>
                                ");
                            }
                        }

                    ?>
                    
                </div>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-2">
                <div style="margin-left: 80px;margin-right: 80px;">
                    <?php
                        $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` WHERE `organiser_id` = 1";
                        $result = mysqli_query($conn, $sql);
                        if($row['event_date'] >= date("Y-m-d"))
                        {
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $eventID = $row['event_id'];
                                $sql1 = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` INNER JOIN `ticketType` ON `event`.`event_id` = `ticketType`.`event_id` WHERE `event`.`event_id` = $eventID";
                                $result1 = mysqli_query($conn, $sql1);
                                $minPrice = 999999;
                                $maxPrice = 0;
                                $buttonPrice = "";

                                if (mysqli_num_rows($result1) > 0) {
                                    while($row1 = mysqli_fetch_assoc($result1)) {
                                        if($row1['price'] >= $maxPrice)
                                        {
                                            $maxPrice = $row1['price'];
                                        }
                                        if($row1['price'] <= $minPrice)
                                        {
                                            $minPrice = $row1['price'];
                                        }
                                    
                                    }
                                }
                                if($maxPrice == 0)
                                {
                                    $buttonPrice = "Free";
                                }
                                else
                                {
                                    $buttonPrice = "RM ".$minPrice . " - RM " . $maxPrice;
                                }
                                echo("
                                    <div class=\"card\" style=\"margin-top: 20px;\">
                                        <div class=\"card-body shadow\">
                                            <h4 class=\"card-title\">".$row['event_name']."</h4>
                                            <h6 class=\"text-muted card-subtitle mb-2\">".$row['status']."</h6>
                                            <h5>Date: ".$row['event_date']." - ".$row['eventEnd_date']."</h5>
                                            <h5>Price: $buttonPrice</h5><button class=\"btn btn-primary float-end\" type=\"button\" style=\"background: rgb(163, 31, 55);width: 164.5px;\">Dashboard</button>
                                        </div>
                                    </div>
                                ");
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-3">
            <div style="margin-left: 80px;margin-right: 80px;">
                    <?php
                        $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` WHERE `organiser_id` = 1";
                        $result = mysqli_query($conn, $sql);
                        if($row['event_date'] < date("Y-m-d"))
                        {
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $eventID = $row['event_id'];
                                $sql1 = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` INNER JOIN `ticketType` ON `event`.`event_id` = `ticketType`.`event_id` WHERE `event`.`event_id` = $eventID";
                                $result1 = mysqli_query($conn, $sql1);
                                $minPrice = 999999;
                                $maxPrice = 0;
                                $buttonPrice = "";

                                if (mysqli_num_rows($result1) > 0) {
                                    while($row1 = mysqli_fetch_assoc($result1)) {
                                        if($row1['price'] >= $maxPrice)
                                        {
                                            $maxPrice = $row1['price'];
                                        }
                                        if($row1['price'] <= $minPrice)
                                        {
                                            $minPrice = $row1['price'];
                                        }
                                    
                                    }
                                }
                                if($maxPrice == 0)
                                {
                                    $buttonPrice = "Free";
                                }
                                else
                                {
                                    $buttonPrice = "RM ".$minPrice . " - RM " . $maxPrice;
                                }
                                echo("
                                    <div class=\"card\" style=\"margin-top: 20px;\">
                                        <div class=\"card-body shadow\">
                                            <h4 class=\"card-title\">".$row['event_name']."</h4>
                                            <h6 class=\"text-muted card-subtitle mb-2\">".$row['status']."</h6>
                                            <h5>Date: ".$row['event_date']." - ".$row['eventEnd_date']."</h5>
                                            <h5>Price: $buttonPrice</h5><button class=\"btn btn-primary float-end\" type=\"button\" style=\"background: rgb(163, 31, 55);width: 164.5px;\">Dashboard</button>
                                        </div>
                                    </div>
                                ");
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Below Template -->
    </div>
    <!-- /.container-fluid -->

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

<?php
    require __DIR__ . '/footer.php'
?>