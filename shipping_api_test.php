<?php 
  define("HOST","localhost");
  define("USERNAME","sgcprot1_SGC_ESHOP");
  define("PASSWORD","3g48B8Qn8k6v6VF");
  define("DATABASE","sgcprot1_SGC_ESHOP");

  //create database connection
  $conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);

  if(!$conn)
  {
      die("Connection Failed".mysqli_connect_error());
  }
  else
  {
      if(!isset($_SESSION)){
          session_start();
      }
  }

//get seller id -> retrieve seller shipping option from db
$sellerUID = 11; //*TO GET*
$customerUID = 3; //TO GET * from session
    //Under the same seller
    $productlength =[];
    $productwidth = [];
    $productheight = 0;

  $cartsql = "SELECT product_ID, quantity FROM cart WHERE user_ID = '$customerUID'";
  $result = $conn->query($cartsql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

    $product = $row['product_ID'];
    $productQty = $row['quantity'];

   //===========To get product weight, height, and width of the product==================
    $sqlinfo = "SELECT product_length, product_width, product_height, product_weight FROM product WHERE product_id = '$product'";
    $stmt = $conn->prepare($sqlinfo);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($prod = $result->fetch_assoc()) {

    //to calculate parcel size of including all products
    array_push($productlength, $prod['product_length']);
    array_push($productwidth, $prod['product_width']);

    $productheight += $prod['product_height'] * $quantity; // Sum (Height (cm) x Quantity)

    }
  }
}
  $maximumlength = max($productlength);
  $maximumwidth = max($productwidth);
  
  echo $productheight, $maximumlength, $maximumwidth;


   //===========To get customer shipping information==================
$customersql ="SELECT
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
  $result = $conn->query($customersql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$cPhone = $row['phone_number'];
$cContactName  = $row['contact_name'];
$cFullAddress = $row['address'];
$cPostalCode = $row['postal_code'];
$cState = $row['state'];
}
  }

//===========To get seller shipping information==================
$sellersql ="SELECT
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

$result = $conn->query($sellersql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

$sPhone = $row['phone_number'];
$sContactName  = $row['contact_name'];
$sFullAddress = $row['address'];
$sPostalCode = $row['postal_code'];
$sState = $row['state'];
}
}
echo "seller". $sPhone, $sContactName, $sFullAddress, $sPostalCode,, $sState, $sPhone

//if get is not null then
$domain = "https://demo.connect.easyparcel.my/?ac=";

$action = "MPRateCheckingBulk";
$postparam = array(
'authentication'	=> 'LoFwGSDIZ4',
'api'	=> 'EP-1ksAmVhmY',
'bulk'	=> array(
array(
'pick_code'	=> $sPhone,//'10050',
'pick_state'	=>$sState,//'png',
'pick_country'	=> 'MY',
'send_code'	=> $cPostalCode, //'11950',
'send_state'	=> $cState,//'png',
'send_country'	=> 'MY',
'weight'	=> '5',
'width'	=>$maximumwidth,// '0',
'length'	=> $maximumlength,// '0',
'height'	=>$productheight,//'0',
'date_coll'	=> date("Y-m-d"), //'2022-4-10',
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

