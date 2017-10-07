<?php

defined('APP_BIN') or exit('APP_BIN wasn\'t declared');

use \Lollipop\Config;

/**
 * Cache
 * 
 * @package lmvc
 * @version 1.2
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
     * @var     array   Arguments
     * 
     */
    private $_args = [];
    
    /**
     * @var     string  Active command
     * 
     */
    private $_command = '';
    
    /**
     * Class Construct
     * 
     * @param   array   Project config
     * @param   array   Parameters
     * @return  void
     * 
     */
    function __construct(array $args) {
        // Get [0] as active command
        $this->_command = isset($args[0]) ? $args[0] : '';
        
        // Remaining will be treated as parameters
        $this->_args = array_splice($args, 1, count($args) - 1);
        
        switch (strtolower($this->_command)) {
            case 'purge':
                // Cache purging
                $this->_purge();
                
                break;
            case 'remove':
                // Remove cache
                if (!count($this->_args)) {
                    // This functionality requires arguments
                    // as cache key
                    Console::error('Missing keys.');
                }
                
                // Execute `remove`
                $this->_remove();
                
                break;
            case 'get':
                // Recover cache
                if (!count($this->_args)) {
                    // This functionality requires arguments
                    // as cache key
                    Console::error('Missing keys.');
                }
                
                // Get cache value
                $this->_get();
                
                break;
            default:
                // Nah...
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
        $i = 0; // Key index
        
        foreach($this->_args as $key) {
            // Display value for cache key
            // [{key}]
            // {value}
            echo "[$key]", PHP_EOL, (string)\Lollipop\Cache::recover($key), PHP_EOL;
            
            if ($i + 1 < count($this->_args))
                // Some separator for each key...
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
        // All configuration, regarding cache folder will
        // be load by `Lollipop\Cache` from what configuration is
        // set on application `app/config.php`
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
        // Remove all cache from cache folder or database
        // configured on application `app/config.php`
        \Lollipop\Cache::purge();
    }
}
