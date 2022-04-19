<?php
 require_once __DIR__ . '/mysqli_connect.php';
   if($_SESSION['login'] == false)
  {
  	echo "<script>alert('Login to checkout');
  		window.location.href='login.php';</script>";
  }
 echo $_SESSION['uid'];

 


$customerUID = $_SESSION['uid'];

  //Under the same seller
  $productlength =[];
  $productwidth = [];
  $productheight = 0;
  $productweight =0;
  
  $cartsql = "SELECT product_ID, quantity FROM cart WHERE user_ID = '$customerUID'";
  $result = $conn->query($cartsql);

  if ($result->num_rows > 1) { //if multiple product in cart
    while($row = $result->fetch_assoc()) {
     
    $productQty = $row['quantity'];

    // Multiple items in one order: Volumetric weight calculation (kg) = Max Length (cm) x Max Width (cm) x Sum (Height (cm) x Quantity) / 5000.
    //===========To get product weight, height, and width of the product==================
    $sqlinfo = "SELECT product_length, product_width, product_height, product_weight FROM product WHERE product_id = '$row[product_ID]'";
    $iresult = $conn->query($sqlinfo);
    if (mysqli_num_rows($iresult) > 0) {
        while ($prod = $iresult->fetch_assoc()) {
        
            array_push($productlength, $prod['product_length']);
            array_push($productwidth, $prod['product_width']);
            $productheight += $prod['product_height']* $productQty;  // Sum (Height (cm) x Quantity)
            //$productweight += $prod['product_weight'] 
            
        }
    }
  }
$maximumlength = max($productlength);
$maximumwidth = max($productwidth);
$volumetricWeight = $maximumlength* $maximumwidth* $productheight/5000;
}
else  { //if only one item in cart
    while($row = $result->fetch_assoc()) {
        $productQty = $row['quantity'];
        echo $row['quantity'], $row['product_ID'];

        //Single item in one order: Volumetric weight calculation (kg) = Height (cm) x Width (cm) x Length (cm) / 5000.        
        //===========To get product weight, height, and width of the product==================
            $sqlinfo = "SELECT product_length, product_width, product_height, product_weight FROM product WHERE product_id = '$row[product_ID]'";
            $iresult = $conn->query($sqlinfo);
            if (mysqli_num_rows($iresult) > 0) {
                while ($prod = $iresult->fetch_assoc()) {
                    echo $prod['product_height'],$prod['product_width'], $prod['product_weight'];
                    if ($productQty == 1) 
                    {
                        $volumetricWeight = $prod['product_height']* $prod['product_width']* $prod['product_length']/5000;
                    }
                    else{
                        $volumetricWeight = ($prod['product_height']*$productQty)* $prod['product_width']* $prod['product_length']/5000;

                    }
                }
            }
        }
}

echo $volutetricWeight;
  
  //echo $productheight, $maximumlength, $maximumwidth;
  //echo $productweight;



?>

