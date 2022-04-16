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

/* $db = new mysqli($dbConfig['HOST'], $dbConfig['USERNAME'], $dbConfig['PASSWORD'], $dbConfig['NAME']);
$results = mysqli_query($db,"SELECT * FROM paymentPaypal where id='4' ");
		$row = mysqli_fetch_array($results);
echo $row['invoice_id']; 
echo $row['transaction_id'];
echo $row['payment_amount'];
echo $row['payment_status']; 
echo $row['product_id']; 
echo $row['product_name']; */

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

