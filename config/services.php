<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Modules\Users\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'upayments' => [
        'merchant_id' => env('UPAY_MERCHANT_ID', 1201),
        'username' => env('UPAY_USERNAME', 'test'),
        'password' => env('UPAY_PASSWORD', 'test'),
        'api_key' => env('UPAY_API_KEY', 'jtest123'),
        'test_mode' => env('UPAY_TEST_MODE', 1),
        'whitelabled' => env('UPAY_WHITELABLED', 0),
        'url' => env('UPAY_URL', 'https://api.upayments.com/test-payment'),
    ],
    "send_mail_alert"=> env("SEND_MAIL_ALERT", true)

];
