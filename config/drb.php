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

    'googleCalendar' => [
        'clientId' => '420129696907-m22u3e7jbiss9h4t4ovdli2scqtdj1np.apps.googleusercontent.com',
        'clientSecret' => 'Uhf2L6-TB6Rmozj5KIV0bQWY',
    ],
];