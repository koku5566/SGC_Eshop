<?php 
 require __DIR__ . '/header.php';

//get seller id -> retrieve seller shipping option from db
$sellerUID = 11; //*TO GET*
$customerUID = 3; //TO GET *

  $checkoutProduct = array ( //productid, quantity
    array(000034,2),
    array(000035,2)
  );

  $productlength =[];
  $productwidth = [];
  $productheight = 0;


  foreach($checkoutProduct as $product => $quantity){
    echo $product, $quantity;
  }




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

echo $sPhone,$sContactName, $sFullAddress, $sPostalCode, $sState;

require __DIR__ . '/footer.php'
?>

