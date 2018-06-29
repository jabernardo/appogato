<?php

return [
    /**
     * Get stored message from cache
     * 
     * GET /api/test/get
     * 
     */
    'api/test/get' => [
            'method' => [ 'GET' ],
            'callback' => 'API\\Sample.get',
            'middlewares' => [
                new \App\Middleware\JSend()
            ]
        ],
    
    /**
     * Get stored message from cache
     * 
     * POST /api/test/set?message=hello+there
     * 
     */
    'api/test/set' => [
            'method' => [ 'POST', 'PUT' ],
            'callback' => 'API\\Sample.set',
            'middlewares' => [
                new \App\Middleware\JSend()
            ]
        ]
];
