<?php

/**
 * Application version
 *
 */
$config['app'] = array(
        'name' => 'Lollipop Sample App',
        'version' => '1.0',
        'author' => 'Programmer'
    );

/**
 * Anti-CSRF
 * 
 * 
 */
$config['anti_csrf'] = array(
        'enable' => true,       // Enable or disable this functionality
        'name' => 'sugar',      // Application keyword
        'key' => '',            // Salt
        'expiration' => 1800    // or 30mins
    );

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
$config['not_found_page'] = '';

/**
 * Environment switches
 *
 * dev/stg/prd
 *
 */
$config['env'] = 'dev';

/**
 * Cache location
 *
 */
$config['cache'] = array(
        'folder' => APP_CORE_CACHE
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
 * Autoload folders
 *
 */
$config['autoload'] = array(
         APP_CORE_CONTROLLER
    );

/**
 * Overrides per environment
 * 
 */
$config['overrides'] = array(
        // Development
        'dev' => array(
                'debugger' => true,
                'db' => array(
                        // Database
                        'host' => 'localhost',
                        'username' => 'root',
                        'password' => '',
                        'database' => 'phpmyadmin'
                )
            ),
        // Staging
        'stg' => array(
                'debugger' => false,
                'db' => array(
                        // Database
                        'host' => 'localhost',
                        'username' => 'root',
                        'password' => '',
                        'database' => 'aldrich'
                )
            ),
        // Production
        'prd' => array(
                'debugger' => false,
                'db' => array(
                        // Database
                        'host' => 'localhost',
                        'username' => 'root',
                        'password' => '',
                        'database' => 'aldrich'
                )
            )
    );
