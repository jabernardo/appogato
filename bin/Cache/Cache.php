<?php

defined('APP_BIN') or exit('APP_BIN wasn\'t declared');

use \Lollipop\Config;

/**
 * Cache
 * 
 * @package lmvc
 * @version 1.0
 * @author  John Aldrich Bernardo
 * @email   4ldrich@protonmail.com
 * @description
 * 
 * Class for Cache
 * 
 */
class Cache
{
    /**
     * Class Construct
     * 
     * @param   array   Project config
     * @param   array   Parameters
     * @return  void
     * 
     */
    function __construct(array $args) {
        $this->_args = $args;
        $this->_command = isset($args[0]) ? $args[0] : '';
        
        switch (strtolower($this->_command)) {
            case 'purge':
                $this->_purge();
                break;
            default:
                Console::error('Unknown command.');
                break;
        }
    }
    
    /**
     * Purge cache
     * 
     * @return  void
     * 
     */
    private function _purge() {
        \Lollipop\Cache::purge();
    }
}
