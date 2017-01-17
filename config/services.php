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
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '1185278984858994',
        'client_secret' => 'b89438934cbabfa5f30fa4b3da7ac8cc',
        'redirect' => url('/').'/social/facebookCallback',
    ],

    'google' => [
        'client_id' => '1053061296653-62d9au7j5iel0286chc5fahtjfmf2bou.apps.googleusercontent.com',
        'client_secret' => 'OGXrifVlmYDpQZKXEgKNlMtI',
        'redirect' => url('/').'/social/googleCallback',
    ],

    'linkedin' => [
        'client_id' => '',
        'client_secret' => '',
        'redirect' => url('/').'/social/linkedinCallback',
    ],
];
