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
    'client_id' => 'AXwUvCxvA69PZNIw8yROCF9avXuWCThOctoMyva-gTq4HZ4fvr23JQEv-B-e5XAoyqlAO33O4o1-jg0V',
    'client_secret' => 'EPNDx2VJTNtxPcL_mU16_eVR4EVHo3AwpjiIThwsyBEbDZV6XRknodG6qkRoE9G6dBJoGo6dA5zmriLa',
    'return_url' => 'https://eshop.sgcprototype2.com/PaypalSuccess.php',
    'cancel_url' => 'https://eshop.sgcprototype2.com/payment-cancelled.html'
];

// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'sgcprot1_SGC_ESHOP',
    'password' => '3g48B8Qn8k6v6VF',
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
