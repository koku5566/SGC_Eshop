<?php
    //require __DIR__ . '/header.php';
    include __DIR__.'../mysqli_connect.php';

    //remove product from cart table
    if (isset($_POST['removeItemBtn'])) {
        $sql_delete_cart = "UPDATE `cart` SET `remove_product` = 1, `update_at` = now() WHERE `cart_ID`= ".$_POST['cartID']."";
        mysqli_query($conn, $sql_delete_cart);

        // remember change the path from '/test/cart.php' to '/cart.php'
        echo "<script type='text/javascript'>
                window.location.href = window.location.origin + '/test/cart.php';
            </script>";
    } 
    unset($_POST['removeItemBtn']);

    //update product quantity store in cart
    if (isset($_POST['quantity'])) {
        $cart_id = $_POST['cart_id'];
        $quantity = $_POST['quantity'];

        $sql_update_quantity = "UPDATE `cart` SET `quantity`='$quantity',`update_at`= now() WHERE `cart_ID` = '$cart_id'";
        $query_update_quantity = mysqli_query($conn,$sql_update_quantity);
    }
    unset($_POST['cart_id']);
    unset($_POST['quantity']);

    //update product variation  
    if (isset($_POST['variation_id'])) {
        $cart_id = $_POST['cart_id2'];
        $variation_id = $_POST['variation_id'];

        $sql_update_variation = "UPDATE `cart` SET `variation_id`='$variation_id',`update_at`= now() WHERE `cart_ID` = '$cart_id'";
        $query_update_variation = mysqli_query($conn,$sql_update_variation);

        if ($query_update_variation) {
            echo "pass";
        }
        else
        {
            echo "failed";
        }
    }
    unset($_POST['cart_id2']);
    unset($_POST['variation_id']);
?>