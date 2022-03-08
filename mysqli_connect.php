<?php
    define("HOST","103.6.198.112 ");
    define("USERNAME","sgcprot1_SGC_ESHOP ");
    define("PASSWORD","bXrAcmvi,B#U");
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



