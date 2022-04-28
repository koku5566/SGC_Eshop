<?php
    require __DIR__ . '/header.php';
    include __DIR__.'../mysqli_connect.php';
    session_start();

    //remove product from cart table
    if (isset($_POST['removeItemBtn'])) {
        $sql_delete_cart = "UPDATE `cart` SET `remove_product` = 1, `update_at` = now() WHERE `cart_ID`= ".$_POST['cartID']."";
        mysqli_query($conn, $sql_delete_cart);

        // remember change the path from '/test/cart.php' to '/cart.php'
        echo "<script type='text/javascript'>
                window.location.href = window.location.origin + '/cart.php';
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

    //get subtotal
    if (isset($_POST['subtotal'])) {
        $_SESSION['subtotal'] = $_POST['subtotal'];

        echo "<script type='text/javascript'>
                window.location.href = window.location.origin + '/checkout.php';
            </script>";
    }

    // validate voucher code
    if (isset($_POST['voucher_code'])) {

        $voucher_code = $_POST['voucher_code'];

        $sql_voucher_code = "SELECT `discount_amount`, `vouncher_type` FROM `vouncher` WHERE `vouncher_code` = '$voucher_code'";
        $query_voucher_code = mysqli_query($conn, $sql_voucher_code);

        while ($row = mysqli_fetch_assoc($query_voucher_code)) {
            echo $row['discount_amount']." and ".$row['vouncher_type'];
        }
    }

    // send email notification to user.
    if (isset($_POST['notify']))
    {
        $user_id = $_POST['userID'];

        $sql_user_id ="SELECT *
                    FROM `user`
                    WHERE userAddress.user_id = '$userID'"; 

        $query_user_id = mysqli_query($conn, $sql_user_id);  
        $row = mysqli_fetch_assoc($query_user_id);
        $user_email = $row['email'];
        $user_name = $row['name'];

        $to = $user_email;
        $subject = "Product out of stock";
        $from = "info@sgcprototype2.com";
        $from2 = "info@sgcprototype2.com";
        $fromName = "SGC E-Shop";

        $headers =  "From: $fromName <$from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed;\r\n";


        $message = "
            <p>We will infom you when this product is restock agian. Thank you.</p>
        ";

        $HTMLcontent = "<p><b>Dear $user_name</b>,</p><p>$message</p>";

        $boundary = md5(time());
        $headers .= " boundary=\"{$boundary}\"";
        $message = "--{$boundary}\r\n";
        $message .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
        $message .= "Content-Transfer-Encoding: 7bit\r\n";
        $message .= $HTMLcontent . "\r\n";
        $message .= "--{$boundary}\r\n";
        $returnPath = "-f" . $from2;

        if (@mail($to, $subject, $message, $headers, $returnPath)) {
            echo "<script type='text/javascript'>
                    window.location.href = window.location.origin + '/cart.php';
                </script>";
        } else {
            echo "<script>alert('Error')</script>";
        }
    }
?> 
