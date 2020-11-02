<?php
/**
 * Created by PhpStorm.
 * User: Lizard
 * Date: 11/1/2020
 * Time: 1:49 PM
 */

return [
  'paymentType' => [
    'tutorial'      => 'tutorial',
    'research'      => 'research',
    'subscription'  => 'subscription',
  ],

    'sslPaymentUrls' => [
        'requestUrl' => 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php',
        'validationUrl' => 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php'
    ]
];