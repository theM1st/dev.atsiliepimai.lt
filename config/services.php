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
        'client_id' => '606639046211281',
        'client_secret' => 'b485d29ca0a0eac3621781ed78eff68f',
        'redirect' => env('APP_URL').'/social/facebookCallback',
    ],

    'google' => [
        'client_id' => '966588477442-n81448e0nn8pn2ntjgb4sgq96angi08g.apps.googleusercontent.com',
        'client_secret' => '03iz4l7gO41r2wPP8Y2afS9a',
        'redirect' => env('APP_URL').'/social/googleCallback',
    ],

    'linkedin' => [
        'client_id' => '786qcq3kddlf23',
        'client_secret' => 'SV8h74jAGmnJXLAy',
        'redirect' => env('APP_URL').'/social/linkedinCallback',
    ],
];
