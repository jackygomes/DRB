<?php
/**
 * Created by PhpStorm.
 * User: Lizard
 * Date: 11/1/2020
 * Time: 1:49 PM
 */

return [
    'paymentType' => [
        'tutorial' => 'tutorial',
        'research' => 'research',
        'subscription' => 'subscription',
    ],

    'sslPaymentUrls' => [
        'requestUrl' => (env('APP_ENV') == 'production') ? 'https://securepay.sslcommerz.com/gwprocess/v4/api.php' : 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php',
        'validationUrl' => env('APP_ENV') == 'production' ? 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php' : 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php'
    ],

    'sslCredentials' => [
        'storeID' => env('SSL_STORE_ID'),
        'storePass' => env('SSL_STORE_PASS'),
    ],
];