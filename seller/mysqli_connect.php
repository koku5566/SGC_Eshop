<?php
    define("HOST","localhost");
    define("USERNAME","root");
    define("PASSWORD","");
    define("DATABASE","segieshop");

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



