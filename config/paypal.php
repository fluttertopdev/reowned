<?php

return [
    'mode' => 'sandbox',

    'sandbox' => [
        'client_id' => env('PAYPAL_CLIENT_ID', 'test'), // 👈 important
        'client_secret' => env('PAYPAL_SECRET', 'test'),
        'app_id' => 'APP-80W284485P519543T',
    ],

    'live' => [
        'client_id' => env('PAYPAL_CLIENT_ID', 'test'),
        'client_secret' => env('PAYPAL_SECRET', 'test'),
        'app_id' => '',
    ],
];