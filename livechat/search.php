<?php
    session_start();
    include_once "mysqli_connect.php";

    $outgoing_id = $_SESSION['userid'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM user WHERE NOT userID = {$outgoing_id} AND (username LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        require __DIR__ . '/livechat/info.php';
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>