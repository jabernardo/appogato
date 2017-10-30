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
define('APP_CORE_CONTROLLER', APP_CORE . 'controller/');
define('APP_CORE_MODEL', APP_CORE . 'model/');
define('APP_CORE_VIEW', APP_CORE . 'view/');
define('APP_CORE_HELPER', APP_CORE . 'helper/');
define('APP_CORE_CACHE', APP_CORE . 'cache/');
define('APP_CORE_LOG', APP_CORE . 'log/');
define('APP_CORE_DB', APP_CORE . 'db/');
define('APP_CORE_DEBUG', APP_CORE . 'debug/');

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

/**
 * Initialize configuration in Lollipop
 * 
 */
\Lollipop\Config::load($config);

/** Clear overrides **/
if (isset($config['overrides'])) unset($config['overrides']);

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
            'App\\Helper\\' => APP_CORE_HELPER
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
 * Include routes
 * 
 */
if (!file_exists(APP_CORE . 'routes.php'))
    die('Routes not found!');

require_once(APP_CORE_DEBUG . 'info.php');
require_once(APP_CORE . 'routes.php');

if (!isset($routes) && !is_array($routes))
    die('Invalid routes!');

/**
 * Index Page using Controller
 *
 */
$controller_prefix = 'App\\Controller\\';
 
foreach ($routes as $route => $value) {
    if (is_callable($value)) {
        \Lollipop\HTTP\Route::all($route, $value);
    } else if (is_string($value)) {
        \Lollipop\HTTP\Route::all($route, $controller_prefix . $value);
    } else if (is_array($value)) {
        $value['path'] = $route;
        
        if (is_string($value['callback'])) {
            $value['callback'] = $controller_prefix . $value['callback'];
        }
        
        \Lollipop\HTTP\Route::serve($value);
    }
}
