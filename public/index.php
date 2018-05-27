<?php

/**
 * Lollipop for MVC
 * An extensive and flexible library for PHP
 *
 * @package    Lollipop for MVC
 * @version    2.0
 * @author     John Aldrich Bernardo <bjohnaldrich@gmail.com>
 * @copyright  Copyright (C) 2017 John Aldrich Bernardo. All rights reserved.
 * @license
 *
 * Copyright (c) 2017 John Aldrich Bernardo
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, 
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR 
 * THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 */

/**
 * Load Lollipop-PHP
 *
 */
require_once(realpath(dirname(__DIR__)) . '/vendor/autoload.php');

/**
 * Paths
 * 
 */
define('APP_ROOT', realpath(dirname(__DIR__)));
define('APP_CORE', APP_ROOT . '/app/');
define('APP_CORE_CONFIG', APP_ROOT . '/app/config/');
define('APP_CORE_ROUTES', APP_ROOT . '/app/routes/');
define('APP_CORE_CONTROLLER', APP_CORE . 'controller/');
define('APP_CORE_MODEL', APP_CORE . 'model/');
define('APP_CORE_VIEW', APP_CORE . 'view/');
define('APP_CORE_HELPER', APP_CORE . 'helper/');
define('APP_CORE_MIDDLEWARE', APP_CORE . 'middleware/');
define('APP_CORE_CACHE', APP_CORE . 'cache/');
define('APP_CORE_LOG', APP_CORE . 'log/');
define('APP_CORE_DB', APP_CORE . 'db/');
define('APP_CORE_DEBUG', APP_CORE . 'debug/');

/**
 * Autoload function
 * for controllers
 * 
 */
spl_autoload_register(function($class) {
    // project-specific namespace prefix
    $prefixes = array(
            'App\\Controller\\' => APP_CORE_CONTROLLER,
            'App\\Model\\' => APP_CORE_MODEL,
            'App\\Helper\\' => APP_CORE_HELPER,
            'App\\Middleware\\' => APP_CORE_MIDDLEWARE
        );

    foreach ($prefixes as $prefix => $base_dir) {
        // does the class use the namespace prefix?
        $len = strlen($prefix);
        
        if (strncmp($prefix, $class, $len) !== 0) {
            // no, move to the next registered prefix
            continue;
        }
        
        // get the relative class name
        $relative_class = substr($class, $len);
    
        // replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        
        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }
});

/**
 * Load configuration files
 *
 */
$config = [];

foreach (glob(APP_CORE_CONFIG . '*.php') as $config_file) {
    $config = array_merge_recursive($config, include($config_file));
}

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

/**
 * Initialize configuration in Lollipop
 * 
 */
\Lollipop\Config::load($config);

/**
 * Include routes
 * 
 */
foreach (glob(APP_CORE_ROUTES . '*.php') as $route_file) {
    require_once($route_file);
}

if (!isset($route) && !is_array($route))
    die('Invalid routes!');


if (!strcmp(php_sapi_name(), 'cli'))
    return;

/**
 * Lollipop Debugger
 * 
 */
require_once(APP_CORE_DEBUG . 'info.php');

/**
 * Controller Pre-fix for LMVC Application
 *
 */
$controller_prefix = 'App\\Controller\\';

/**
 * Register every route
 * to lollipop dispatcher
 * 
 */
foreach ($route as $key => $value) {
    if (is_callable($value)) {
        \Lollipop\HTTP\Router::all($key, $value);
    } else if (is_string($value)) {
        \Lollipop\HTTP\Router::all($key, $controller_prefix . $value);
    } else if (is_array($value)) {
        $value['path'] = $key;
        
        if (is_string($value['callback'])) {
            $value['callback'] = $controller_prefix . $value['callback'];
        }
        
        \Lollipop\HTTP\Router::serve($value);
    }
}
