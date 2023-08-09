<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '6879865815461329',  //client face của bạn
        'client_secret' => 'db5eeced63fc991d40e896fb8b3a33dd',  //client app service face của bạn
        'redirect' => 'http://localhost:8000/dashboard' //callback trả về
    ],

    'google' => [
        'client_id' => '704197331591-55kumhmg3jdhj0d787gpim91s4dkeoni.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/auth/google/callback'
    ],

];
