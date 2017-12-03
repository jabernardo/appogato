<?php

/**
 * Application version
 *
 */
$config['app'] = [
        'name' => 'Lollipop Sample App',
        'version' => '1.0',
        'author' => 'Programmer',
        'email' => 'youremail@domain.ext'
    ];

/**
 * Anti-CSRF
 * 
 */
$config['anti_csrf'] = [
        'enable' => true,       // Enable or disable this functionality
        'name' => 'sugar',      // Application keyword
        'key' => '',            // Salt
        'expiration' => 1800    // or 30mins
    ];

/**
 * Disable XSS injection in Page::render
 * 
 */
$config['anti_xss'] = true;

/**
 * Feature Switches
 *
 */
$config['switch'] = [
        // For your custom logs you can use this switch
        'logs' => true
    ];
    
/**
 * Output
 * 
 */
$config['output'] = [
        // Compression (gzip)
        'compression' => false
    ];

/**
 * Development tools
 *
 * @note    Enables purging of cache
 * 
 */
$config['dev_tools'] = true;

/**
 * Lollipop Debugger
 * 
 */
$config['debugger'] = true;

/**
 * 404 Not Found Page
 * 
 */
$config['page_not_found'] = [
        'show'  => true,
        'route' => '404'
    ];

/**
 * Environment switches
 *
 * dev/stg/prd
 *
 */
$config['environment'] = 'dev';

/**
 * Cache location
 *
 */
$config['cache'] = [
        'folder' => APP_CORE_CACHE
    ];

/**
 * Local DB storage
 * 
 */
$config['localdb'] = [
        'folder' => APP_CORE_DB
    ];

/**
 * Application logs 
 *
 */
$config['log'] = [
        'enable' => true,
        'folder' => APP_CORE_LOG
    ];

/**
 * Overrides per environment
 * 
 */
$config['overrides']['dev'] = [
    // Development
    'cache' => [
            'driver' => 'memcached',
            'servers' => [
                [ 'memcached', '11211' ]
            ]
        ],
    'debugger' => true,
    'db' => [
        // Database
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'aldrich'
    ]
];


// Staging
$config['overrides']['stg'] = [
    'debugger' => false,
    'db' => [
        // Database
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'aldrich'
    ]
];

// Production
$config['overrides']['prd'] = [
    'debugger' => false,
    'db' => [
        // Database
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'aldrich'
    ]
];
