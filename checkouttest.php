<?php
 require_once __DIR__ . '/mysqli_connect.php';
   if($_SESSION['login'] == false)
  {
  	echo "<script>alert('Login to checkout');
  		window.location.href='login.php';</script>";
  }
 echo $_SESSION['userid'];

 


$customerUID = $_SESSION['userid'];
//$customerUID = 'U000018';
  //Under the same seller
  $productlength =[];
  $productwidth = [];
  $sellers=[]; 
  $shippingPriceBySeller = [];
  $productheight = 0;
  $totalShippingPrice = 0; // shipping price for all cart item

 // $productweight =0;
  $volumetricWeight = 0;
  
    // to identify different sellers from the cart item 
  $sellersql = "SELECT DISTINCT shop_id FROM cart WHERE user_ID = '$customerUID' AND remove_Product = 0";
  $result = $conn->query($sellersql);
  if ($result->num_rows > 0) { //if multiple product in cart
    while($row = $result->fetch_assoc()) {
        array_push($sellers, $row['shop_id']);
    }
    }   
    //Loop seller one by one to calculate each shop's shipping price 
    for($i=0; $i<count($sellers); $i++)
    {
        $sellerid = $sellers[i];

        $cartsql = "SELECT product_ID, quantity, shop_id FROM cart WHERE user_ID = '$customerUID'  AND shop_id = '$sellerid' AND remove_Product = 0";
        $result = $conn->query($cartsql);
      
        if ($result->num_rows > 1) { //if multiple product in cart
          while($row = $result->fetch_assoc()) {
           
          $productQty = $row['quantity'];
      
          // Multiple items in one order: Volumetric weight calculation (kg) = Max Length (cm) x Max Width (cm) x Sum (Height (cm) x Quantity) / 5000.
          $sqlinfo = "SELECT product_length, product_width, product_height, product_weight FROM product WHERE product_id = '$row[product_ID]'";
          $iresult = $conn->query($sqlinfo);
          if (mysqli_num_rows($iresult) > 0) {
              while ($prod = $iresult->fetch_assoc()) {
                  array_push($productlength, $prod['product_length']);
                  array_push($productwidth, $prod['product_width']);
                  $productheight += $prod['product_height']* $productQty;  // Sum (Height (cm) x Quantity)
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
              //echo $row['quantity'], $row['product_ID'];
      
              //Single item in one order: Volumetric weight calculation (kg) = Height (cm) x Width (cm) x Length (cm) / 5000.        
                  $sqlinfo = "SELECT product_length, product_width, product_height, product_weight FROM product WHERE product_id = '$row[product_ID]'";
                  $iresult = $conn->query($sqlinfo);
                  if (mysqli_num_rows($iresult) > 0) {
                      while ($prod = $iresult->fetch_assoc()) {
                          echo 'h:',$prod['product_height'],'w:',$prod['product_width'], 'weight:',$prod['product_weight'];
                          if ($productQty == 1) 
                          {
                              $volumetricWeight = $prod['product_height']* $prod['product_width']* $prod['product_length']/5000;
                          }
                          else{ //if quantity more than 1 
                              $volumetricWeight = ($prod['product_height']*$productQty)* $prod['product_width']* $prod['product_length']/5000;
      
                          }
                      }
                  }
              }
      }
      
    
 
echo 'volumetric= ',$volumetricWeight;
$shippingprice=0;
//rates referred from: https://poslajutracking.org/poslaju-rates/
switch($volumetricWeight){
    case $volumetricWeight <= 0.500:
        $shippingprice = 6.00;
        break;
    case $volumetricWeight> 0.500 && $volumetricWeight<=0.750:
        $shippingprice = 7.00;
        break;   
    case $volumetricWeight> 0.750 && $volumetricWeight<=1.00:
        $shippingprice = 8.50;
        break;        
    case $volumetricWeight> 1.00 && $volumetricWeight<=1.25:
        $shippingprice = 10.00;
        break;    
    case $volumetricWeight>1.25 && $volumetricWeight<=1.50:
        $shippingprice = 1.00;
        break;
    case $volumetricWeight>1.50 && $volumetricWeight<=1.75:
        $shippingprice = 12.50;
        break;  
    case $volumetricWeight>1.75 && $volumetricWeight<=2.00:
        $shippingprice = 14.00;
        break; 
    case $volumetricWeight>2.00 && $volumetricWeight<=2.50:
        $shippingprice = 21.00;
        break;
    case $volumetricWeight>2.50 && $volumetricWeight<=3.00:
        $shippingprice = 24.00;
        break;
    default:
        $shippingprice = 'Please contact staff for price';
    }

    echo $shippingprice;
    array_push($shippingPriceBySeller, $shippingprice);
    print_r($shippingPriceBySeller);
 
}
    print_r(array_sum($shippingPriceBySeller));
  //echo 'shippingprice:',$shippingprice;
  //echo $productheight, $maximumlength, $maximumwidth;
  //echo $productweight;



?>

