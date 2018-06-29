<?php

defined('APP_NAMESPACE_CONTROLLER') or die('Lollipop wasn\'t loaded correctly.');

/**
 * -----------------------------------------------------------------------------
 * Register routes for our application
 * -----------------------------------------------------------------------------
 * 
 */

// Turn-off auto-dispatch mode since will be also using
// this portion for loading cli commands
\Lollipop\Config::set('router.auto_dispatch', false);

// Load routes from `app/routes` folder
$routes = require(APP_BOOT . 'routes.php');

foreach ($routes as $key => $value) {
    if (is_callable($value)) {
        // Callable routes
        \Lollipop\HTTP\Router::all($key, $value);
    } else if (is_string($value)) {
        // Basic Routes using controllers are allowed to be access
        // using any HTTP methods
        \Lollipop\HTTP\Router::all($key, APP_NAMESPACE_CONTROLLER . $value);
    } else if (is_array($value)) {
        // Advance routing for using middlewares or strict HTTP method checking
        $value['path'] = $key;
        
        if (is_string($value['callback'])) {
            // Make sure to attach controller prefix on our application
            $value['callback'] = APP_NAMESPACE_CONTROLLER . $value['callback'];
        }
        
        // Serve custom route for our application...
        \Lollipop\HTTP\Router::serve($value);
    } else {
        throw new \Lollipop\HTTP\Route('Invalid route: "' . $key . '"');
    }
}
