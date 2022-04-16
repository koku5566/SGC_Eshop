<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<div class="wrapper">
  <?php 
    $paymentid = $_GET['payid'];
		$results = mysqli_query($dbConfig,"SELECT * FROM paymentPaypal where id='4' ");
		$row = mysqli_fetch_array($results);
  ?>
	  <div class="status">
      <h4>Payment Information</h4>
      <p>Reference Number: <?php echo $row['invoice_id']; ?></p>
      <p>Transaction ID: <?php echo $row['transaction_id']; ?></p>
      <p>Paid Amount: <?php echo $row['payment_amount']; ?></p>
      <p>Payment Status: <?php echo $row['payment_status']; ?></p>
      <h4>Product Information</h4>
      <p>Product id: <?php echo $row['product_id']; ?></p>
      <p>Product Name: <?php echo $row['product_name']; ?></p>
    </div>
  </div>

</body>
</html>
<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
require __DIR__. '/autoload.php';


// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'client_id' => 'AfVucqlI4wppM3dgw64w50OfTjj3rajP_qfFaDKoqTP7QXOgYI5UcuEWsogFS1xL4EEdo3zHlcsKAJxs',
    'client_secret' => 'EHXBKEv-_c5nqL1Wyj4LAaCAA-Sam3mFCK1XQv6555_AktOE5Ksge_SYZhikgWPWr929bmn8lN01Dui4',
    'return_url' => 'https://eshop.sgcprototype2.com/PaypalSuccess.php',
    'cancel_url' => 'https://eshop.sgcprototype2.com/payment-cancelled.html'
];

// Database settings. Change these for your database configuration.
 $dbConfig = [
    'HOST' => 'localhost',
    'USERNAME' => 'sgcprot1_SGC_ESHOP',
    'PASSWORD' => '3g48B8Qn8k6v6VF',
    'NAME' => 'sgcprot1_SGC_ESHOP'
]; 

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret, $enableSandbox = false)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}

