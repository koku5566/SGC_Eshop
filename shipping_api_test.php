<?php 


//get seller id -> retrieve seller shipping option from db
$sellerUID = 11; //*TO GET*
$customerUID = 3; //TO GET * from session

  // $checkoutProduct = array ( //productid, quantity
  //   array(000034,2),
  //   array(000035,2)
  // );
  
  $cartsql = "SELECT * FROM cart WHERE 'user_ID = '$customerID'";
  $stmt = $conn->prepare($cartsql);
  $stmt->execute();
  $result = $stmt->get_result();


  //Under the same seller
  $productlength =[];
  $productwidth = [];
  $productheight = 0;

  while ($row = $result->fetch_assoc()) {

    $product = $row['product_ID'];
    $productQty = $row['quantity'];

    $sqlinfo = "SELECT product_length, product_width, product_height, product_weight FROM product WHERE id = '$product'";
    $stmt = $conn->prepare($sqlinfo);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {

    //to calculate parcel size of including all products
    array_push($productlength, $row['product_length']);
    array_push($productwidth, $row['product_width']);

    $productheight += $row['product_height'] * $quantity; // Sum (Height (cm) x Quantity)

   

    }
  }
  $maximumlength = max($productlength);
  $maximumwidth = max($productwidth);
  
  echo $productheight, $maximumlength, $maximumwidth;
  //===========To get product weight, height, and width of the product==================


 


$sql2 ="SELECT
id.user,
contact_name.userAddress,
phone_number.userAddress,
address.userAddress,
postal_code.userAddress,
area.userAddress,
state.userAddress,
country.userAddress
FROM
user
JOIN userAddress ON user.id = userAddress.user_id
WHERE
user.id = $customerUID";

$stmt = $conn->prepare($sql2);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
$cPhone = $row['phone_number'];
$cContactName  = $row['contact_name'];
$cFullAddress = $row['address'];
$cPostalCode = $row['postal_code'];
$cState = $row['state'];
}


$sql ="SELECT
id.user,
contact_name.userAddress,
phone_number.userAddress,
address.userAddress,
postal_code.userAddress,
area.userAddress,
state.userAddress,
country.userAddress
FROM
user
JOIN userAddress ON user.id = userAddress.user_id
WHERE
user.id = $sellerUID";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {

$sPhone = $row['phone_number'];
$sContactName  = $row['contact_name'];
$sFullAddress = $row['address'];
$sPostalCode = $row['postal_code'];
$sState = $row['state'];
}

?>

