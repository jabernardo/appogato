<?php

/**
 * Config Overrides
 * 
 * @return  array   Config overrides for application
 * 
 */

return [
    'overrides' => [
        
        /**
         * Development
         * 
         */
         
        'dev' => [
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
        ],
        
        /**
         * Staging
         * 
         */
        
        'stg' => [
            'debugger' => false,
            'db' => [
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'database' => 'aldrich'
            ]
        ],
        
        /**
         * Production
         * 
         */
         
        'prd' => [
            'debugger' => false,
            'db' => [
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'database' => 'aldrich'
            ]
        ]
    ]
];
