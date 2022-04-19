<?php
require __DIR__ . '/header.php'
?>

<?php
if (isset($_GET['ticketID'])) {
    $tID = $_GET['ticketID'];
    $_SESSION['ticketSelected'] = $_GET['ticketID'];
    
}
$eID =  $_SESSION['eventPurchaseID'];
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST["registerParticipant"])) {

    //create entry
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $today = date("Y-m-d");
    $now = date("H:i");
    $pay = "register";



    $sqlEntry = "INSERT INTO `formEntry`(`entry_date`, `entry_time`, `event_id`, `payment_status`) VALUES (?,?,?,?)";
    if ($stmt = mysqli_prepare($conn, $sqlEntry)) {
        if (false === $stmt) {
            die('Error with prepare: ') . htmlspecialchars($mysqli->error);
        }
        $bp = mysqli_stmt_bind_param($stmt, "ssis", $today, $now, $eID, $pay);
        if (false === $bp) {
            die('Error with bind_param: ') . htmlspecialchars($stmt->error);
        }
        $bp = mysqli_stmt_execute($stmt);
        if (false === $bp) {
            die('Error with execute: ') . htmlspecialchars($stmt->error);
        }
        if (mysqli_stmt_affected_rows($stmt) == 1) {
            $entryID = mysqli_stmt_insert_id($stmt);
            $_SESSION['formEntry'] = $entryID;
        } else {
            $error = mysqli_stmt_error($stmt);
            echo "<script>alert($error);</script>";
        }
        mysqli_stmt_close($stmt);
    }


    //Insert each value into responses table
    $sql1 = "SELECT * FROM `formElement` WHERE `event_id` = $eID";
    $result1 = mysqli_query($conn, $sql);
    $formCount = 0;
    $counter = 0;

    if (mysqli_num_rows($result) > 0) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $fieldName = $row1['field_name'];
            if (!empty($_POST["$fieldName"])) {
                $formCount++;
                

                $value = mysqli_real_escape_string($conn, SanitizeString($_POST["$fieldName"]));
                $formID = $row1['form_element_id'];

                $sql2 = "INSERT INTO `formResponse`(`form_id`, `entry_id`, `value`) VALUES (?,?,?)";
                if ($stmt2 = mysqli_prepare($conn, $sql2)) {
                    if (false === $stmt2) {
                        die('Error with prepare: ') . htmlspecialchars($mysqli->error);
                    }
                    $bp = mysqli_stmt_bind_param($stmt2, "iis", $formID, $entryID, $value);
                    if (false === $bp) {
                        die('Error with bind_param: ') . htmlspecialchars($stmt2->error);
                    }
                    $bp = mysqli_stmt_execute($stmt2);
                    if (false === $bp) {
                        die('Error with execute: ') . htmlspecialchars($stmt2->error);
                    }
                    if (mysqli_stmt_affected_rows($stmt2) == 1) {
                        $counter++;
                    } 
                    else {
                        $error = mysqli_stmt_error($stmt2);
                        echo "<script>alert($error);</script>";
                    }
                    mysqli_stmt_close($stmt2);
                }

                if($counter == $formCount){
                    echo "<script>alert('Participant register successful. Proceed to checkout');window.location.href='./eventCheckout.php';</script>";
                }
                else{
                    echo "<script>alert('Error in register. Contact admin for help');window.location.href='./event.php';</script>";
                }
                
            }
        }

    }
}


?>

<title>Register Participant</title>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css">
<link rel="stylesheet" href="/css/event.css">

<!-- Begin Page Content -->
<div class="container-fluid" style="width:80%">
    <!-- Above Template -->
    <h1>Register Event</h1>
    <div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <section style="padding-top: 25px;padding-bottom: 40px;padding-right: 30px;padding-left: 30px;margin-top: 20px;box-shadow: 0px 0px 10px;">
                <div>
                    <div class="row">
                        <h2>Register Participants Details</h2>
                    </div>
                </div>
                <?php
                $sql = "SELECT * FROM `formElement` WHERE `event_id` = $eID";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $input = $row['element_type'];
                        $fieldName = $row['field_name'];

                        if ($input != "select") {
                            if ($row['required'] == "required") {
                                echo ("
                                <div class=\"row\" style=\"margin-top: 10px;\">
                                <label class=\"form-label\" style=\"font-weight: bold;margin-bottom: 0px;padding-right: 0px;\">" . $row['field_name'] . "</label>
                                <input class=\"form-control\" type=\"$input\" placeholder=\"$fieldName\" required name=\"$fieldName\">
                                </div>
                            ");
                            } else {
                                echo ("
                                <div class=\"row\" style=\"margin-top: 10px;\">
                                <label class=\"form-label\" style=\"font-weight: bold;margin-bottom: 0px;padding-right: 0px;\">" . $row['field_name'] . "</label>
                                <input class=\"form-control\" type=\"$input\" placeholder=\"$fieldName\" name=\"$fieldName\">
                                </div>
                                ");
                            }
                        } else {
                            $option = $row['selection'];
                            $optionArr = preg_split("/\,/", $option);

                            echo ("
                                <div class=\"row\" style=\"margin-top: 10px;\">
                                <label class=\"form-label\" style=\"font-weight: bold;margin-bottom: 0px;padding-right: 0px;\">" . $row['field_name'] . "</label>
                                <select class=\"form-select\" name=\"$fieldName\">
                            ");

                            foreach ($optionArr as $selection) {
                                echo ("
                                    <option value=\"$selection\" >$selection</option>
                                ");
                            }

                            echo ("
                                </select>
                                </div>
                            ");
                        }
                    }
                }

                ?>
            </section>
            <div style="margin-top: 61px;text-align: center;margin-bottom: 61px;">
                <div class="btn-group" role="group">
                    <button class="btn btn-primary" type="submit" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);" name="registerParticipant">Submit</button>
                </div>
            </div>
        </form>



    </div>



    <!-- Below Template -->
</div>
<!-- /.container-fluid -->

<script src="/bootstrap/js/bootstrap.min.js"></script>

<?php
require __DIR__ . '/footer.php'
?>