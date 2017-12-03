<?php

/**
 * Application version
 *
 */
$config['app'] = array(
        'name' => 'Lollipop Sample App',
        'version' => '1.0',
        'author' => 'Programmer',
        'email' => 'youremail@domain.ext'
    );

/**
 * Anti-CSRF
 * 
 */
$config['anti_csrf'] = array(
        'enable' => true,       // Enable or disable this functionality
        'name' => 'sugar',      // Application keyword
        'key' => '',            // Salt
        'expiration' => 1800    // or 30mins
    );

/**
 * Disable XSS injection in Page::render
 * 
 */
$config['anti_xss'] = true;

/**
 * Feature Switches
 *
 */
$config['switch'] = array(
        // For your custom logs you can use this switch
        'logs' => true
    );
    
/**
 * Output
 * 
 */
$config['output'] = array(
        // Compression (gzip)
        'compression' => false
    );

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
$config['page_not_found'] = array(
        'show'  => true,
        'route' => '404'
    );

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
$config['cache'] = array(
        'folder' => APP_CORE_CACHE
    );

/**
 * Local DB storage
 * 
 */
$config['localdb'] = array(
        'folder' => APP_CORE_DB
    );

/**
 * Application logs 
 *
 */
$config['log'] = array(
        'enable' => true,
        'folder' => APP_CORE_LOG
    );

/**
 * Overrides per environment
 * 
 */
$config['overrides']['dev'] = array(
    // Development
    'cache' => array(
            'driver' => 'memcached',
            'servers' => array (
                array( 'memcached', '11211' )
            )
        ),
    'debugger' => true,
    'db' => array(
        // Database
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'aldrich'
    )
);


// Staging
$config['overrides']['stg'] = array(
    'debugger' => false,
    'db' => array(
        // Database
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'aldrich'
    )
);

// Production
$config['overrides']['prd'] = array(
    'debugger' => false,
    'db' => array(
        // Database
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'aldrich'
    )
);
