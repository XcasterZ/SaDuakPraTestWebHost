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

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'), // แก้ไขเป็น GOOGLE_CLIENT_ID
        'client_secret' => env('GOOGLE_CLIENT_SECRET'), // แก้ไขเป็น GOOGLE_CLIENT_SECRET
        'redirect' => env('GOOGLE_REDIRECT'), // ใช้ env แทน
    ],

    'facebook' => [
        'client_id' => '877982537205402', // แก้ไขเป็น GOOGLE_CLIENT_ID
        'client_secret' => '51d8895724dc952d32e128ab9eae58dc', // แก้ไขเป็น GOOGLE_CLIENT_SECRET
        'redirect' => 'https://saduakpratestwebhost-production.up.railway.app/auth/facebook/callback', // ใช้ env แทน
    ],


];
