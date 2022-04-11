<?php
use paypal\Rest\ApiContext;
use paypal\Auth\OAuthTokenCredential;

require '/autoload.php';

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
    'host' => 'localhost',
    'username' => 'sgcprot1_SGC_ESHOP',
    'password' => 'bXrAcmvi,B#U',
    'name' => 'sgcprot1_SGC_ESHOP'
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
