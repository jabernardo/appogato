<?php

/**
 * LMVC Bin
 * 
 * Auto-loader for Tools Classes
 * 
 * 
 */

defined('APP_BIN') or exit('APP_BIN wasn\'t declared');

// Register autoloader
spl_autoload_register(function($class) {
    // app/bin/{class}/{class}
    $df = APP_BIN . $class . '/' . $class . '.php';
    
    if (file_exists($df)) {
        require_once($df);
    }
});
