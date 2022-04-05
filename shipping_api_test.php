<?php 


//get seller id -> retrieve seller shipping option from 
$sellerUID = 11; //*TO GET*
$customerUID = 3; //TO GET *


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
array(
'pick_code'	=> '10050',
'pick_state'	=> 'png',
'pick_country'	=> 'MY',
'send_code'	=> '11950',
'send_state'	=> 'png',
'send_country'	=> 'MY',
'weight'	=> '5',
'width'	=> '0',
'length'	=> '0',
'height'	=> '0',
'date_coll'	=> '2022-4-10',
),
array(
'pick_code'	=> '14300',
'pick_state'	=> 'png',
'pick_country'	=> 'MY',
'send_code'	=> '81100',
'send_state'	=> 'jhr',
'send_country'	=> 'MY',
'weight'	=> '10',
'width'	=> '5',
'length'	=> '15',
'height'	=> '5',
'date_coll'	=> '2017-11-10',
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

