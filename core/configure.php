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
 *  - dev (development)
 *  - stg (staging)
 *  - prd (production)
 */
if (isset($config['environment'])) {
    $env_selected = strtolower($config['environment']);

    switch ($env_selected) {
        case 'development':
        case 'staging':
        case 'production':
            $config = array_replace(
                $config,
                require(APP_CORE_CONFIG . "env/$env_selected.php")
            );

            break;
        default:
            die('Environment was invalid');
            break;
    }
}

return $config;
