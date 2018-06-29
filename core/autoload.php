<?php


/**
 * -----------------------------------------------------------------------------
 * Namespaces required for Appogato autoloading
 * -----------------------------------------------------------------------------
 * 
 */
define('APP_NAMESPACE_CONTROLLER',  'App\\Controller\\');
define('APP_NAMESPACE_MODEL',       'App\\Model\\');
define('APP_NAMESPACE_HELPER',      'App\\Helper\\');
define('APP_NAMESPACE_MIDDLEWARE',  'App\\Middleware\\');

/**
 * -----------------------------------------------------------------------------
 * Auto-Loading
 * -----------------------------------------------------------------------------
 * 
 * Appogato requires to auto-load the following namespaces:
 * 
 *  - \App\Controller
 *  - \App\Model
 *  - \App\Helper
 *  - \App\Middleware
 * 
 */
spl_autoload_register(function($class) {
    // project-specific namespace prefix
    $prefixes = array(
        // Application Controllers Namespace
        APP_NAMESPACE_CONTROLLER    => APP_CORE_CONTROLLER,
        
        // Application Model Namespace
        APP_NAMESPACE_MODEL         => APP_CORE_MODEL,
        
        // Application Helper Namespace
        APP_NAMESPACE_HELPER        => APP_CORE_HELPER,
        
        // Application Middlewares Namespace
        APP_NAMESPACE_MIDDLEWARE    => APP_CORE_MIDDLEWARE
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
