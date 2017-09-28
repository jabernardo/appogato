<?php

defined('APP_BIN') or exit('APP_BIN wasn\'t declared');

use \Lollipop\Config;

/**
 * Cache
 * 
 * @package lmvc
 * @version 1.1
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
        
        $this->_args = array_splice($args, 1, count($args) - 1);
        
        switch (strtolower($this->_command)) {
            case 'purge':       // Cache purging
                $this->_purge();
                break;
            case 'remove':      // Remove cache
                if (!count($this->_args)) {
                    Console::error('Missing keys.');
                }
                
                $this->_remove();
                break;
            case 'get':      // Remove cache
                if (!count($this->_args)) {
                    Console::error('Missing keys.');
                }
                
                $this->_get();
                break;
            default:
                Console::error('Unknown command.');
                break;
        }
    }
    
    /**
     * Get value of cache
     * 
     * @access  private
     * @return  void
     * 
     */
    private function _get() {
        $i = 0;
        foreach($this->_args as $key) {
            echo "[$key]", PHP_EOL, (string)\Lollipop\Cache::recover($key), PHP_EOL;
            
            if ($i + 1 < count($this->_args))
                echo '--------------------------------------------------------------', PHP_EOL;
            
            $i++;
        }
    }
    
    /**
     * Remove cache by keys
     * 
     * @access  private
     * @return  void
     * 
     */
    private function _remove() {
        foreach($this->_args as $key) {
            \Lollipop\Cache::remove($key);
        }
    }
    
    /**
     * Purge cache
     * 
     * @access  private
     * @return  void
     * 
     */
    private function _purge() {
        \Lollipop\Cache::purge();
    }
}
