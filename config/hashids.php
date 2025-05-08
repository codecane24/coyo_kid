<?php

return [
    'default' => 'main',

    'connections' => [
        'main' => [
            'salt' => env('APP_KEY'), // or a custom value
            'length' => 8,
        ],
    ],
];

