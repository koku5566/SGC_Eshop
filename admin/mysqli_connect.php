<?php
    define("HOST","localhost");
    define("USERNAME","sgcprot1_SGC_ESHOP");
    define("PASSWORD","3g48B8Qn8k6v6VF");
    define("DATABASE","sgcprot1_SGC_ESHOP");

    //create database connection
    $conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);

    if(!$conn)
    {
        die("Connection Failed".mysqli_connect_error());
    }
    else
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }
?>



