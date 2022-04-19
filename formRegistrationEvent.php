<?php
require __DIR__ . '/header.php'
?>

<?php
if (isset($_GET['ticketID'])) {
    $tID = $_GET['ticketID'];
    $_SESSION['ticketSelected'] = $_GET['ticketID'];
    $eID =  $_SESSION['eventPurchaseID'];
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
        <form>
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

                        if ($input != "select") {
                            if ($row['required'] == "required") {
                                echo ("
                                <div class=\"row\" style=\"margin-top: 10px;\">
                                <label class=\"form-label\" style=\"font-weight: bold;margin-bottom: 0px;padding-right: 0px;\">" . $row['field_name'] . "</label>
                                <input class=\"form-control\" type=$input placeholder=" . $row['field_name'] . " required name=" . $row['field_name'] . ">
                                </div>
                            ");
                            } else {
                                echo ("
                                <div class=\"row\" style=\"margin-top: 10px;\">
                                <label class=\"form-label\" style=\"font-weight: bold;margin-bottom: 0px;padding-right: 0px;\">" . $row['field_name'] . "</label>
                                <input class=\"form-control\" type=$input placeholder=" . $row['field_name'] . " name=" . $row['field_name'] . ">
                                </div>
                                ");
                            }
                        } else {
                            $option = $row['selection'];
                            $optionArr = preg_split("/\,/", $option);
                            
                            echo ("
                                <div class=\"row\" style=\"margin-top: 10px;\">
                                <label class=\"form-label\" style=\"font-weight: bold;margin-bottom: 0px;padding-right: 0px;\">" . $row['field_name'] . "</label>
                                <select class=\"form-select\" name=" . $row['field_name'] . ">
                            ");

                            foreach ($optionArr as $selection)
                            {
                                echo("
                                    <option value=$selection >$selection</option>
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
                <div class="btn-group" role="group"><button class="btn btn-primary" type="button" style="margin-left: 5px;margin-right: 5px;background: rgb(163, 31, 55);">Submit</button></div>
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