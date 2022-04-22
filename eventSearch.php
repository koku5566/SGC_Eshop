<?php
require __DIR__ . '/header.php'
?>

<?php
if (isset($_POST['searchEventNameBtn'])) {
    $search = mysqli_real_escape_string($conn, SanitizeString($_POST["eNameSearch"]));
    echo ("
        <script>window.location.href=\"eventSearch.php?searchEvent=$search\"</script>
        ");
}
if (isset($_POST['searchEventDateBtn'])) {
    $date = mysqli_real_escape_string($conn, SanitizeString($_POST["eDateSearch"]));
    echo ("
        <script>window.location.href=\"eventSearch.php?searchDate=$date\"</script>
        ");
}
?>

<title>Event</title>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="/css/event.css">
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
    <!-- Above template -->
    <div class="row">
        <div class="d-none d-sm-none d-md-none d-lg-inline d-xl-inline d-xxl-inline col-lg-3 col-xl-3 col-xxl-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Filter</h5>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">By Location</h5>
                        </div>
                        <div class="card-body">
                        <ul class="list-unstyled">
                                <a href="eventSearch.php?location=Perlis">
                                    <li style="margin-bottom: 5px;">Perlis</li>
                                </a>
                                <a href="eventSearch.php?location=Kedah">
                                    <li style="margin-bottom: 5px;">Kedah</li>
                                </a>
                                <a href="eventSearch.php?location=Pulau Pinang">
                                    <li style="margin-bottom: 5px;">Pulau Pinang</li>
                                </a>
                                <a href="eventSearch.php?location=Perak">
                                    <li style="margin-bottom: 5px;">Perak</li>
                                </a>
                                <a href="eventSearch.php?location=Selangor">
                                    <li style="margin-bottom: 5px;">Selangor</li>
                                </a>
                                <a href="eventSearch.php?location=Kuala Lumpur">
                                    <li style="margin-bottom: 5px;">Kuala Lumpur</li>
                                </a>
                                <a href="eventSearch.php?location=Putrajaya">
                                    <li style="margin-bottom: 5px;">Putrajaya</li>
                                </a>
                                <a href="eventSearch.php?location=Kelantan">
                                    <li style="margin-bottom: 5px;">Kelantan</li>
                                </a>
                                <a href="eventSearch.php?location=Terengganu">
                                    <li style="margin-bottom: 5px;">Terengganu</li>
                                </a>
                                <a href="eventSearch.php?location=Pahang">
                                    <li style="margin-bottom: 5px;">Pahang</li>
                                </a>
                                <a href="eventSearch.php?location=Negeri Sembilan">
                                    <li style="margin-bottom: 5px;">Negeri Sembilan</li>
                                </a>
                                <a href="eventSearch.php?location=Melaka">
                                    <li style="margin-bottom: 5px;">Melaka</li>
                                </a>
                                <a href="eventSearch.php?location=Johor">
                                    <li style="margin-bottom: 5px;">Johor</li>
                                </a>
                                <a href="eventSearch.php?location=Sabah">
                                    <li style="margin-bottom: 5px;">Sabah</li>
                                </a>
                                <a href="eventSearch.php?location=Sarawak">
                                    <li style="margin-bottom: 5px;">Sarawak</li>
                                </a>
                                <a href="eventSearch.php?location=Labuan">
                                    <li style="margin-bottom: 5px;">Labuan</li>
                                </a>
                                <a href="eventSearch.php?location=Online">
                                    <li style="margin-bottom: 5px;">Online</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 22px;">
                        <div class="card-header">
                            <h5 class="mb-0">By date</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="input-group"><input class="form-control" type="date" name="eDateSearch" />
                                    <div class="input-group-append"><button class="btn btn-primary" type="submit" style="background: rgb(163, 31, 55);" name="searchEventDateBtn"><i class="fa fa-search"></i></button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 22px;">
                        <div class="card-header">
                            <h5 class="mb-0">By Name</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="input-group"><input class="form-control" type="text" name="eNameSearch" />
                                    <div class="input-group-append"><button class="btn btn-primary" type="submit" style="background: rgb(163, 31, 55);" name="searchEventNameBtn"><i class="fa fa-search"></i></button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm12 col-md-12 col-lg-9 col-xl-9 col-xxl-9">
            <div class="row">
                <?php
                $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` WHERE `event`.`status` = 'Approved'";
                if (isset($_GET['location'])) {
                    $location = $_GET['location'];
                    $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` WHERE `event`.`status` = 'Approved' AND `event`.`location` = \"$location\"";
                }
                if (isset($_GET['date'])) {
                    $date = $_GET['date'];
                    $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` WHERE `event`.`status` = 'Approved' AND `event`.`eventEnd_date` <= \"$date\"";
                }
                if (isset($_GET['searchEvent'])) {
                    $nameEvent = $_GET['searchEvent'];
                    $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` WHERE`event`.`event_name` LIKE '%$nameEvent%' AND `event`.`status` = 'Approved'";
                }
                if (isset($_GET['searchDate'])) {
                    $dateEvent = $_GET['searchDate'];
                    $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` WHERE `event`.`status` = 'Approved' AND `event`.`eventEnd_date` >= \"$dateEvent\" AND `event`.`event_date` <= \"$dateEvent\"";
                }
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

                        //check price
                        $sql1 = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id` INNER JOIN `ticketType` ON `event`.`event_id` = `ticketType`.`event_id` WHERE `event`.`event_id` = $eventID";
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
                        } else if ($minPrice == $maxPrice) {
                            $buttonPrice = "RM " . $maxPrice;
                        } else {
                            $buttonPrice = "RM " . $minPrice . " - RM " . $maxPrice;
                        }

                        echo ("
                    <div class=\"col-12 col-sm12 col-md-6 col-lg-6 col-xl-4 col-xxl-4\" style=\"margin-top: 20px;margin-bottom: 20px;\">
                        <div class=\"card\">
                            <div class=\"card-body\"><img src=\"$picLocation\" style=\"width:100%;\" />
                                <h3 class=\"card-title\" style=\"margin-top: 10px;\">" . $row['event_name'] . "</h3>
                                <h1 style=\"color: rgb(163, 31, 55);font-size: 20px;\">" . $row['location'] . "</h1>
                                <h5 style=\"font-size: 20px;margin-bottom: 6px;margin-top: 19px;\">Date: $eventDate</h5>
                                <h4 style=\"font-size: 20px;\">Organizer: " . $row['name'] . "</h4><a href=\"eventDetails.php?eventID=" . $row['event_id'] . "\"><button class=\"btn btn-primary float-end\" type=\"button\" style=\"margin-top: 5px;background: rgb(163, 31, 55);padding-right: 25px;padding-left: 25px;\">$buttonPrice</button></a>
                            </div>
                        </div>
                    </div>
                    ");
                    }
                } else {
                    echo ("
                    <h1 style=\"color: rgb(163, 31, 55);\">No Result Found</h1>
                    ");
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Below Template -->
</div>
<!-- /.container-fluid -->

<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
<script src="/js/Suneditor-WYSIWYG.js"></script>

<?php
require __DIR__ . '/footer.php'
?>