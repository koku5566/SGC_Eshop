<?php
require __DIR__ . '/header.php'
?>

<title>Event</title>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="/css/event.css">
<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
    <!-- Above template -->
    <div class="row">
        <?php
        $sql = "SELECT * FROM `event` INNER JOIN `user` ON `organiser_id` = `user_id`";
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
                } 
                else if($minPrice == $maxPrice) {
                    $buttonPrice = "RM " . $maxPrice;
                }
                else{
                    $buttonPrice = "RM " . $minPrice . " - RM " . $maxPrice;
                }

                echo ("
                    <div class=\"col-sm-3\" style=\"margin-top: 20px;margin-bottom: 20px;\">
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
        }
        ?>
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