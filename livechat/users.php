<?php
    session_start();
    require_once __DIR__ . '/mysqli_connect.php';
    $outgoing_id = $_SESSION['userid'];
    $sql = "SELECT * FROM user WHERE userID != '$outgoing_id' AND (role = 'SELLER' OR role = 'ADMIN') ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        require __DIR__ . '/livechat/info.php';
    }
    echo $output;
?>