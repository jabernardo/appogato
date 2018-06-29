<?php

/**
 * -----------------------------------------------------------------------------
 * Application Routes
 * -----------------------------------------------------------------------------
 * 
 * @var array
 * 
 */
$route = [];

/**
 * Load all routes in routes folder
 * 
 */
foreach (glob(APP_CORE_ROUTES . '*.php') as $route_file) {
    $route = \Lollipop\Utils::array_merge($route, include($route_file));
}

if (!isset($route) && !is_array($route))
    die('Invalid routes!');

return $route;
