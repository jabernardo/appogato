<?php

/**
 * Application Routes goes here...
 *
 */

/** Home Page **/
// $routes['/'] = 'WelcomeController.indexAction';
$routes['/'] = [
    'callback' => 'Sample\\Welcome.indexAction',
    'method' => '' /*  array('GET', 'POST') */,
    'cachable' => true
];

/** 404 Page Not Found **/
$routes['404'] = 'Sample\\Error.pagenotfoundAction';
