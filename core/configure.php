<?php

/**
 * -----------------------------------------------------------------------------
 * Appogato: Configuration
 * -----------------------------------------------------------------------------
 * 
 * Configuration in initializing lollipop application
 * 
 * @var     $config     array
 * 
 */
$config = [];

/**
 * Load all configuration files in configurations folder
 * 
 */
foreach (glob(APP_CORE_CONFIG . '*.php') as $config_file) {
    $config = array_merge_recursive($config, include($config_file));
}

/**
 * Destroy application if set with wrong configurations
 *
 */
if (!isset($config) && !is_array($config))
    die('Configuration was invalid');
    
/**
 * Check if environment is valid
 *
 * Valid environments are:
 *  - development
 *  - staging
 *  - production
 */
if (isset($config['environment'])) {
    $env_selected = strtolower($config['environment']);
    $env_config = APP_CORE_CONFIG . "env/$env_selected.php";

    switch ($env_selected) {
        case 'development':
            // Report all
            error_reporting(E_ALL);

            break;
        case 'staging':
            // Report all except notice
            error_reporting(E_ALL & ~E_NOTICE);

            break;
        case 'production':
            // Turn off reporting
            error_reporting(0);

            break;
        default:
            die('Environment was invalid');
            break;
    }

    if (file_exists($env_config)) {
        $config = array_replace(
            $config,
            require($env_config)
        );
    }
}

return $config;
