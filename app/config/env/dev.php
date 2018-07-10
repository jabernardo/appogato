<?php

return [
    /**
     * Memcached server was named `memcached` in this example
     * as configure on `docker-composer.yml`
     */
    'cache' => [
            'driver' => 'memcached',
            'servers' => [
                [ 'memcached', '11211' ]
            ]
        ],
    
    /**
     * Lollipop Debugger (enable/disable)
     * 
     * - This is development environment so we'll turn this feature on!
     * 
     */
    'debugger' => true,

    /**
     * MySQL Database configuration
     * 
     */
    'db' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'aldrich'
    ]
];
