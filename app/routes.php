<?php

/**
 * Application Routes goes here...
 *
 */

$routes = array(
    /** Home Page**/
    // '/' => 'WelcomeController.indexAction'
    '/' => array(
        '.' => 'WelcomeController.indexAction',
        // 'controller' => 'WelcomeController',
        // 'action' => 'indexAction',
        'method' => 'GET' /*  array('GET', 'POST') */,
        'cache' => true
    )
);
