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
    
    /**
     * Feature Switches
     *
     */
    'switch' => [
        // For your custom logs you can use this switch
        'logs' => true
    ],
        
    /**
     * Output
     * 
     */
    'output' => [
        // Compression (gzip)
        'compression' => false
    ],
        
    /**
     * Development tools
     *
     * @note    Enables purging of cache
     * 
     */
    'dev_tools' => true,

    /**
     * Lollipop Debugger
     * 
     */
    'debugger' => true,

    /**
     * Lollipop Error and Exception handler
     * 
     */ 
    'lollipop' => [
        'error' => [
            'handler' => true
        ]
    ],

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
     */
    'cache' => [
        'folder' => APP_CORE_CACHE
    ],
    
    /**
     * Local DB storage
     * 
     */
    'localdb' => [
        'folder' => APP_CORE_DB
    ],
    
    /**
     * Application logs 
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
     */
    'request' => [
        [
            // Auto JSON format
            'json' => true,

            // Request cache
            'cache' => [
                'enable' => true,
                // 'time' => 1440
            ]
        ]
    ],

    // Text Lock and Unlock
    // OpenSSL Encrypt Settings
    'text' => [
        'security' => [
            'method' => 'AES256',
            'key' => SUGAR,
            'iv' => substr(md5(SUGAR), 0, 16)
        ]
    ]
    
];
