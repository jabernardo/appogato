<?php

/**
 * Config Overrides
 * 
 * @return  array   Config overrides for application
 * 
 */

return [
    'overrides' => [
        
        /**
         * Development
         * 
         */
        
        'dev' => require(APP_CORE_CONFIG . 'env/dev.php'),
        
        /**
         * Staging
         * 
         */
        
        'stg' => require(APP_CORE_CONFIG . 'env/stg.php'),
        
        /**
         * Production
         * 
         */
         
        'prd' => require(APP_CORE_CONFIG . 'env/prd.php')
    ]
];
