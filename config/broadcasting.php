<?php

return [

    'default' => env('BROADCAST_DRIVER', 'reverb'),

    'connections' => [

        'reverb' => [
        'driver' => 'reverb',
        'key' => env('REVERB_APP_KEY', 'local'),
        'secret' => env('REVERB_APP_SECRET', 'secret'),
        'app_id' => env('REVERB_APP_ID', 'app-id'),
        'options' => [
            'host' => env('REVERB_HOST', '127.0.0.1'),
            'port' => env('REVERB_PORT', 8080),
            'scheme' => env('REVERB_SCHEME', 'http'),
            'useTLS' => false,
        ],
    ],



        'ably' => [
            'driver' => 'ably',
            'key' => env('ABLY_KEY'),
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],
    ],
];
