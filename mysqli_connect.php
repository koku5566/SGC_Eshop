<?php
    define("HOST","https://c129.mschosting.com:2083/cpsess3924695296/3rdparty/phpMyAdmin/db_structure.php?db=sgcprot1_SGC_ESHOP");
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



