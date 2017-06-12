<?php

/**
 * Lollipop for MVC
 * An extensive and flexible library for PHP
 *
 * @package    Lollipop
 * @version    1.0
 * @author     John Aldrich Bernardo <bjohnaldrich@gmail.com>
 * @copyright  Copyright (C) 2015 John Aldrich Bernardo. All rights reserved.
 * @license
 *
 * Copyright (c) 2016 John Aldrich Bernardo
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
require_once(realpath(dirname(__DIR__)) . '/sys/autoload.php');

/**
 * Paths
 * 
 */
define('APP_ROOT', realpath(dirname(__DIR__)));
define('APP_CORE', APP_ROOT . '/app/');
define('APP_CORE_CONTROLLER', APP_CORE . '/controller/');
define('APP_CORE_MODEL', APP_CORE . '/model/');
define('APP_CORE_VIEW', APP_CORE . '/view/');
define('APP_CORE_HELPER', APP_CORE . '/helper/');
define('APP_CORE_CACHE', APP_CORE . '/cache/');
define('APP_CORE_LOG', APP_CORE . '/log/');
define('APP_CORE_DB', APP_CORE . '/db/');
define('APP_CORE_DEBUG', APP_CORE . '/debug/');

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

require_once(APP_CORE_DEBUG . 'info.php');
require_once(APP_CORE . 'routes.php');
