<?php

/**
 * Application Routes goes here...
 *
 */

/** Home Page **/
// $route['/'] = 'Sample\\Welcome.indexAction';
$route['/'] = [
    'callback' => 'Sample\\Welcome.indexAction',
    'method' => [] /*  [ 'GET', 'POST' ] */,
    'middlewares' => [
        new \Lollipop\HTTP\Middleware\Cache(),
        new \Lollipop\HTTP\Middleware\AntiCsrf()
    ],
    'cache' => true
];

/** 404 Page Not Found **/
$route['404'] = 'Sample\\Error.pagenotfoundAction';
