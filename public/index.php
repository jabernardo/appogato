<?php

/**
 * -----------------------------------------------------------------------------
 * Load Appogato Bootstrap
 * -----------------------------------------------------------------------------
 *
 * Including the bootstrap will
 *  - Load vendors from composer
 *  - Declare constants required by appogato
 *  - Register appogato autoloading
 *  - Load configuration files
 *  - Load routes into application
 *  - Register lollipop-debugger middleware
 * 
 */
require_once(realpath(dirname(__DIR__)) . '/core/bootstrap.php');


/**
 * Dispatch Application
 * 
 */
\Lollipop\HTTP\Router::dispatch();
