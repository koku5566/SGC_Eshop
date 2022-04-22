<?php
    session_start();
    include_once "mysqli_connect.php";
    $outgoing_id = $_SESSION['userid'];
    $sql = "SELECT * FROM user WHERE NOT userID = {$outgoing_id} ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "/livechat/backend/info.php";
    }
    echo $output;
?>