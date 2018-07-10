<?php

/**
 * Application Configuration
 * 
 * @return  array   Config for application
 * 
 */

return [
    
    /**
     * Application version
     *
     */
    'app' => [
        'name' => 'Lollipop Sample App',
        'version' => '1.0',
        'author' => 'Programmer',
        'email' => 'youremail@domain.ext'
    ],
        
    /**
     * Output
     * 
     * - Why this feature is `off`?
     * Turn this thing `on` if you want to compress all responses with 
     * gzip, but it's recommended to use `\Lollipop\HTTP\Middleware\Gzip`
     * on routes. Some responses aren't meant for compression like
     * API responses.
     * 
     */
    'output' => [
        // Compression (gzip)
        'compression' => false
    ],

    /**
     * Lollipop Debugger
     * 
     * - See overrides on `env` folder
     * 
     */
    'debugger' => true,

    /**
     * Environment switches
     *
     * dev/stg/prd
     *
     */
    'environment' => 'dev',
    
    /**
     * Cache location
     *
     * - See `env` for overrides since this feature
     * was configured to use `memcached` in development
     * running on `docker-compose.yml`
     * 
     */
    'cache' => [
        'folder' => APP_CORE_CACHE
    ],
    
    /**
     * Local DB storage
     * 
     * - Want to store `sqlite` databases?
     * 
     */
    'localdb' => [
        'folder' => APP_CORE_DB
    ],
    
    /**
     * Application logs 
     *
     * - Application logging
     * 
     */
    'log' => [
        'enable' => true,
        'folder' => APP_CORE_LOG,
        'hourly' => false
    ],

    /**
     * \Lollipop\HTTP\Request::send
     * cURL Wrapper
     * 
     * - A simple HTTP client using `curl` extension
     * 
     */
    'request' => [
        // Auto JSON format
        'json' => true,

        // Request cache
        'cache' => [
            'enable' => true,
            // 'time' => 1440
        ]
    ],

    /**
     * Security Configuration Section
     * 
     */
    'security' => [
        /**
         * Text Lock and Unlock
         * OpenSSL Encrypt Settings
         * 
         */
        'text' => [
            'method' => 'AES256',
            'key' => SUGAR,
            'iv' => substr(md5(SUGAR), 0, 16)
        ],
    
        /**
         * Anti-CSRF
         * 
         */
        'anti_csrf' => [
            'enable' => true,       // Enable or disable this functionality
            'name' => 'sugar',      // Application keyword
            'key' => '',            // Salt
            'expiration' => 1800    // or 30mins
        ],
        
        /**
         * Disable XSS injection in Page::render
         * 
         */
        'anti_xss' => true,
    ]
];
