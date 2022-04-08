<?php
    $conn = mysqli_connect("localhost","sgcprot1_SGC_ESHOP","bXrAcmvi,B#U","sgcprot1_SGC_ESHOP");
?>

<?php
    if(isset($_POST['query']))
    {
        //Fetch each product information
        $sql_product = $_POST['query'];
        $result_product = mysqli_query($conn, $sql_product);

        if (mysqli_num_rows($result_product) == 1) {
            while($row_product = mysqli_fetch_assoc($result_product)) {
                $return_arr[] = array("price" => $row_product['product_price'],"stock" => $row_product['product_stock']);
            }
            echo json_encode($return_arr);
        }
        else{
            echo json_encode("");
        }
    }
?>