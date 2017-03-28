<?php

/**
 * Load Lollipop-PHP
 *
 */
require_once('./lmvc/sys/autoload.php');

/**
 * Paths
 * 
 */
define('APP_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/lmvc/');
define('APP_CORE', APP_ROOT . 'app/');
define('APP_CORE_CONTROLLER', APP_CORE . 'controller/');
define('APP_CORE_MODEL', APP_CORE . 'model/');
define('APP_CORE_VIEW', APP_CORE . 'view/');
define('APP_CORE_HELPER', APP_CORE . 'helper/');
define('APP_CORE_CACHE', APP_CORE . 'cache/');
define('APP_CORE_LOG', APP_CORE . 'log/');
define('APP_CORE_DB', APP_CORE . 'db/');

/**
 * Load configuration
 *
 */
if (!file_exists(APP_CORE . 'config.php'))
    die('Configuration not found!');

require_once(APP_CORE . 'config.php');

if (!isset($config) && !is_array($config))
    die('Configuration was invalid');
    
/**
 * Check if environment is valid
 * 
 */
if (isset($config['env'])) {
    switch (strtolower($config['env'])) {
        case 'dev':
        case 'stg':
        case 'prd':
            break;
        default:
            die('Environment was invalid');
            break;
    }
}

/** Modify configuration based on environment **/
if (isset($config['env']) && 
    isset($config['overrides']) && 
    isset($config['overrides'][strtolower($config['env'])])) {
    // Merge data
    $config = array_merge($config, $config['overrides'][strtolower($config['env'])]);
}

/** Clear overrides **/
if (isset($config['overrides'])) unset($config['overrides']);

/**
 * Initialize configuration in Lollipop
 * 
 */
\Lollipop\App::init($config);

/**
 * Include routes
 * 
 */
if (!file_exists(APP_CORE . 'routes.php'))
    die('Routes not found!');

require_once(APP_CORE . 'routes.php');
