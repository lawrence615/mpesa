<?php
/**
 * Mpesa API Settings
 */

return [
    'online_checkout' => [
        'passkey' => env('MPESA_ONLINE_CHECKOUT_PASSKEY', ''), // provided by Safaricom
        'merchant_id' => env('MPESA_ONLINE_CHECKOUT_MERCHANT_ID', ''), // provided by Safaricom
        'callback_url' => env('MPESA_ONLINE_CHECKOUT_CALLBACK_URL', '') // configure an endpoint to receive the notifications, POST route
    ],
    'c2b' => [
        'paybill' => env('MPESA_C2B_PAYBILL_NUMBER', '') // provided by Safaricom
    ]
];