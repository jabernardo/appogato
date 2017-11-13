<?php

/**
 * Application Routes goes here...
 *
 */

/** Home Page **/
// $routes['/'] = 'WelcomeController.indexAction';
$route['/'] = [
    'callback' => 'Sample\\Welcome.indexAction',
    'method' => '' /*  array('GET', 'POST') */,
    'cachable' => true
];

/** 404 Page Not Found **/
$route['404'] = 'Sample\\Error.pagenotfoundAction';
