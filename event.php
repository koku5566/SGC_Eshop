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
            $sql = "SELECT * FROM `event` WHERE `event_id` = 30";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {

                    echo("
                    <div class=\"col-sm-3\" style=\"margin-top: 20px;margin-bottom: 20px;\">
                        <div class=\"card\">
                            <div class=\"card-body\"><img src=\"data:image/jpeg;base64,".base64_encode($row['cover_image'])."\"/>
                                <h3 class=\"card-title\" style=\"margin-top: 10px;\">Start your E-Commerce with Shopee!</h3>
                                <h1 style=\"color: rgb(163, 31, 55);font-size: 20px;\">Online</h1>
                                <h5 style=\"font-size: 20px;margin-bottom: 6px;margin-top: 19px;\">Date: 6th October 2021</h5>
                                <h4 style=\"font-size: 20px;\">Organizer: SEGi Group of Colleges</h4><button class=\"btn btn-primary float-end\" type=\"button\" style=\"margin-top: 5px;background: rgb(163, 31, 55);padding-right: 25px;padding-left: 25px;\">Free</button>
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
