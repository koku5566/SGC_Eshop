<?php
    require_once __DIR__ . '/mysqli_connect.php';

    //Fetch each product information
    $sql_product = $_POST['query'];
    $result_product = mysqli_query($conn, $sql_product);

    if (mysqli_num_rows($result_product) > 0) {
        while($row_product = mysqli_fetch_assoc($result_product)) {
            $return_arr[] = array("price" => $row_product['product_price'],"stock" => $row_product['product_stock']);
        }
        echo json_encode($return_arr);
    }
    echo json_encode("");
?>