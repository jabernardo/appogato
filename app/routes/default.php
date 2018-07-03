<?php

/**
 * Application Routes goes here...
 *
 */
 
return [
    
    /** Home Page **/
    '/' => [
        'callback' => 'Sample\\Welcome.indexAction',
        'method' => [] /*  [ 'GET', 'POST' ] */,
        'middlewares' => [
            new \Lollipop\HTTP\Middleware\Cache(),
            new \Lollipop\HTTP\Middleware\Gzip(),
            new \Lollipop\HTTP\Middleware\AntiCsrf()
        ]
    ],
    
    /** 404 Page Not Found **/
    '404' => 'Sample\\Error.pagenotfoundAction'

];
