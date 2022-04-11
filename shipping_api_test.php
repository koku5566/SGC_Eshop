<?php 


//get seller id -> retrieve seller shipping option from 
$sellerUID = 11;


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

