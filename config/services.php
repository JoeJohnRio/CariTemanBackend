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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase' => [
        'api_key' => 'AIzaSyAmH9jx7FtcVu0VqBaL2lhsXp4AoSA',
        'auth_domain' => 'androidproject-e7879.firebaseapp.com',
        'database_url' => 'https://androidproject-e7879.firebaseio.com',
        'secret' => 'M68F9gzoz3I8yO6swYZ7jEHtzBeKqPftykRsxp9Y',
        'storage_bucket' => 'androidproject-e7879.appspot.com',
        'project_id' => 'androidproject-e7879',
        'messaging_sender_id' => '750203652235'
    ]

];
