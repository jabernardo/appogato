<?php

/**
 * Application Routes goes here...
 *
 */

/** Home Page **/
// $routes['/'] = 'WelcomeController.indexAction';
$routes['/'] = array(
    'callback' => 'WelcomeController.indexAction',
    'method' => 'GET' /*  array('GET', 'POST') */,
    'cache' => true
);
