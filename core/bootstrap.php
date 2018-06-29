<?php

/**
 * 
 * -----------------------------------------------------------------------------
 * Appogato - An extensive and flexible library for PHP
 * -----------------------------------------------------------------------------
 *
 * @package    appogato
 * @version    3.0
 * @author     John Aldrich Bernardo <bjohnaldrich@gmail.com>
 * @copyright  Copyright (C) 2018 John Aldrich Bernardo. All rights reserved.
 * @license
 *
 * -----------------------------------------------------------------------------
 * MIT License
 * -----------------------------------------------------------------------------
 * 
 * Copyright (c) 2018 John Aldrich Bernardo
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
 * -----------------------------------------------------------------------------
 * Composer Auto Loading
 * -----------------------------------------------------------------------------
 * 
 * Appogato requires the following packages as dependency:
 * 
 *  - jabernardo/console.php
 *      Used in command-line based application in managing Appogato
 * 
 *  - jabernardo/lollipop-php
 *      Main framework used as back-end
 */
require_once(realpath(dirname(__DIR__)) . '/vendor/autoload.php');


/**
 * -----------------------------------------------------------------------------
 * Declaration of folders within the application
 * -----------------------------------------------------------------------------
 * 
 * Make sure that all folders are existing ***
 * 
 */
define('APP_ROOT',              realpath(dirname(__DIR__)));
define('APP_BOOT',              APP_ROOT . '/core/');
define('APP_CORE',              APP_ROOT . '/app/');
define('APP_CORE_CONFIG',       APP_CORE . 'config/');
define('APP_CORE_ROUTES',       APP_CORE . 'routes/');
define('APP_CORE_CONTROLLER',   APP_CORE . 'controller/');
define('APP_CORE_MODEL',        APP_CORE . 'model/');
define('APP_CORE_VIEW',         APP_CORE . 'view/');
define('APP_CORE_HELPER',       APP_CORE . 'helper/');
define('APP_CORE_MIDDLEWARE',   APP_CORE . 'middleware/');
define('APP_CORE_DEBUG',        APP_CORE . 'debug/');
define('APP_CORE_STORAGE',      APP_CORE . 'storage/');
define('APP_CORE_CACHE',        APP_CORE_STORAGE . 'cache/');
define('APP_CORE_LOG',          APP_CORE_STORAGE . 'log/');
define('APP_CORE_DB',           APP_CORE_STORAGE . 'db/');
define('APP_CORE_UPLOAD',       APP_CORE_STORAGE . 'upload/');

/**
 * -----------------------------------------------------------------------------
 * Register autoloader for Appogato
 * -----------------------------------------------------------------------------
 * 
 */
require_once(APP_BOOT . 'autoload.php');

/**
 * -----------------------------------------------------------------------------
 * Initialize configuration in Lollipop-PHP
 * -----------------------------------------------------------------------------
 * 
 */
\Lollipop\Config::load(require(APP_BOOT . 'configure.php'));

/**
 * -----------------------------------------------------------------------------
 * Load routes into memory
 * -----------------------------------------------------------------------------
 * 
 */
require_once(APP_BOOT . 'register.php');

/**
 * -----------------------------------------------------------------------------
 * Appogato Debug
 * -----------------------------------------------------------------------------
 * 
 * See `app/debug` folder
 * 
 */
require_once(APP_CORE_DEBUG . 'info.php');
