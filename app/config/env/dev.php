<?php

return [
    'cache' => [
            'driver' => 'memcached',
            'servers' => [
                [ 'memcached', '11211' ]
            ]
        ],
    'debugger' => true,
    'db' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'aldrich'
    ]
];
