<?php 


//get seller id -> retrieve seller shipping option from db
$sellerUID = 11; //*TO GET*
$customerUID = 3; //TO GET *

$checkoutProduct = array ( //productid, quantity
    array(000034,2),
    array(000035,2),
  );

  $productlength =[];
  $productwidth = [];
  $productheight = 0;


  foreach($checkoutProduct as $product => $quantity){
    $sqlinfo = " SELECT product_length, product_width, product_height, product_weight FROM product WHERE id = '$product'";
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

//if get is not null then

$domain = "https://demo.connect.easyparcel.my/?ac=";

$action = "MPRateCheckingBulk";
$postparam = array(
'authentication'	=> 'LoFwGSDIZ4',
'api'	=> 'EP-1ksAmVhmY',
'bulk'	=> array(

    //l0oop arraay product
array(
'pick_code'	=> $sPostalCode,//10050
'pick_state'	=> $sState,//'png',
'pick_country'	=> 'MY',
'send_code'	=> $cPostalCode,//'11950',
'send_state'	=> $cState,//'png',
'send_country'	=> 'MY',
'weight'	=> '5', //passed from checkout (get product id)
'width'	=> $maximumwidth,
'length'	=> $maximumlength,
'height'	=> $productheight,
'date_coll'	=> date("Y-m-d"),
),

),
'exclude_fields'	=> array(
'rates.*.pickup_point',
),
);

$url = $domain.$action;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postparam));
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

ob_start(); 
$return = curl_exec($ch);
ob_end_clean();
curl_close($ch);

$json = json_decode($return);
echo "<pre>"; print_r($json); echo "</pre>";

?>

