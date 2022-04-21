<?php
require __DIR__ . '/header.php'
?>

<?php
if(isset($_GET['eventCheckin']))
{
    $_SESSION['eventCheckin'] = $_GET['eventCheckin'];
    $eID = $_SESSION['eventCheckin'];
}
$eID = $_SESSION['eventCheckin'];
// if(isset($_GET['searchID']))
// {
//     $_SESSION['searchID'] = $_GET['searchID'];
//     $tID = $_SESSION['searchID'];
// }
// $tID = $_SESSION['searchID'];

$eventsql = "SELECT *
            FROM `event`
            INNER JOIN `ticket` 
            ON `event`.`event_id` = `ticket`.`event_id`
            WHERE `event`.`event_id` = $eID
            ";



$resultsql = mysqli_query($conn, $eventsql);                                             
$row = mysqli_fetch_array($resultsql);
$eventName = $row['event_name'];
?>

<!-- Begin Page Content -->
<div class="container-fluid" style="width:100%;">
    <!-- Above Template -->
    <title>Event Check-in</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
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

    <div class="card">
        <div class="card-header">
            <h2 style="text-align: center;"><i class="fa fa-calendar-check-o"></i>Check in for <?php echo($eventName)?></h2>
        </div>
        <div class="card-body">
            <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST" enctype="multipart/form-data">
                <div class="input-group"><input class="form-control" type="text" id="searchField" name="searchQuery">
                    <div class="input-group-append"><button class="btn btn-primary" type="submit" style="background: rgb(163, 31, 55);" id="serachBtn" name="searchTicket"><i class="fa fa-search"></i></button></div>
                </div>
            </form>
        </div>
    </div>
    <div class="card" style="margin-top: 30px;">
        <div class="card-header">
            <h5 class="mb-0" style="text-align: center;">Participant Details</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Ticket Name</th>
                            <th>Ticket Generate Date</th>
                            <th>Check-in Status</th>
                            <th>Check-in Date</th>
                            <th>Check-in Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_POST["searchTicket"]))
                            {
                                $queriesUser = $_POST["searchQuery"];
                                $_SESSION['searchID'] = $queriesUser;
                                $ticketsql = "SELECT *
                                            FROM `ticket`
                                            INNER JOIN `ticketType` 
                                            ON `ticket`.`ticketType_id` = `ticketType`.`ticketType_id`
                                            WHERE `ticket`.`ticket_id` = `$queriesUser`
                                            ";

                                $ticketresultsql = mysqli_query($conn, $ticketsql);                                             
                                $row1 = mysqli_fetch_array($ticketresultsql);
                                $id = $row1['ticket_id'];
                                $tName = $row1['ticket_name'];
                                $ticketDate = $row1['ticketGenerate_Date'];
                                echo("$queriesUser,$id,$tName");
                                echo("
                                <tr>
                                <td>$id</td>
                                <td>$tName</td>
                                <td>$ticketDate</td>
                                ");
                                if($row1['check_in'] == 0)
                                {
                                    $checkin = "Not Yet Check in";
                                    echo("
                                    <td>$checkin</td>
                                    <td>-</td>
                                    <td>-</td>
                                    </tr>
                                    ");
                                }
                                else if($row1['check_in'] == 1)
                                {
                                    $checkin = "Checked-in";
                                    echo("
                                    <td>$checkin</td>
                                    <td>".$row1['checkIn_date']."</td>
                                    <td>".$row1['checkIn_time']."</td>
                                    </tr>
                                    ");
                                }

                                }
                                                       
                        ?>
                    </tbody>
                </table>
            </div>
            <div style="text-align: center;"><button class="btn btn-primary" type="button" style="background: rgb(163, 31, 55);">Check in</button></div>
        </div>
    </div>

<!-- <script>
    var searchBtn = document.getElementById("serachBtn");

    searchBtn.addEventListener("click",function(){
        var query = document.getElementById("searchField").value;
        if(query == null || query == "")
        {
            window.alert("Do not search for empty ticket");
        }
        else
        {
            window.location.href="checkInEvent.php?searchID="+query;
        }
    });
</script> -->


    <!-- Below Template -->
</div>
<!-- /.container-fluid -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../js/eventDetails.js"></script>

<?php
require __DIR__ . '/footer.php'
?>