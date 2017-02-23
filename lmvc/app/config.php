<?php

/**
 * Application version
 *
 */
$config['app_version'] = 1.0;

/**
 * Feature Switches
 *
 */
$config['switch'] = array(
        // For your custom logs you can use this switch
        'logs' => true
    );

/**
 * Development tools
 *
 * @note    Enables purging of cache
 * 
 */
$config['dev_tools'] = true;

/**
 * Environment switches
 *
 *
 */
$config['env'] = 'dev';

/**
 * Database connection configuration switcher
 *
 */
$config['db_switcher'] = true;

$config['db_configs'] = array(
        'dev' => array(
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'database' => 'aldrich'
            ),
        'stg' => array(
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'database' => 'aldrich'
            ),
        'prd' => array(
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'database' => 'aldrich'
            )
    );

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
        'enable' => false,
        'folder' => APP_CORE_LOG
    );

/** 
 * Autoload folders
 *
 */
$config['autoload'] = array(
         APP_CORE_CONTROLLER,
         APP_CORE_MODEL,
         APP_CORE_HELPER
    );
