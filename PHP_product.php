<?php
    $conn = mysqli_connect("localhost","sgcprot1_SGC_ESHOP","bXrAcmvi,B#U","sgcprot1_SGC_ESHOP");
?>

<?php
    if(isset($_POST['type']) && $_POST['type'] == 1)
    {
        $productId = $_POST['productId'];
        $VariationName = $_POST['VariationName'];
        $VariationChoice = $_POST['VariationChoice'];

        //Fetch each product information
        $sql_product = "SELECT * FROM variation WHERE product_id = '$productId' AND variation_1_name = '$VariationName' AND variation_1_choice = '$VariationChoice'";
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
    else if(isset($_POST['type']) && $_POST['type'] == 2)
    {
        $productId = $_POST['productId'];
        $VariationName = $_POST['VariationName'];
        $VariationChoice = $_POST['VariationChoice'];
        $Variation2Name = $_POST['Variation2Name'];
        $Variation2Choice = $_POST['Variation2Choice'];

        $sql_product = "SELECT * FROM variation WHERE product_id = '$productId' AND variation_1_name = '$VariationName' AND variation_1_choice = '$VariationChoice' AND variation_2_name = '$Variation2Name' AND variation_2_choice = '$Variation2Choice'";
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