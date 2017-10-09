<?php

defined('APP_BIN') or exit('APP_BIN wasn\'t declared');

use \Lollipop\Config;

/**
 * Log
 * 
 * @package lmvc
 * @version 1.0.0
 * @author  John Aldrich Bernardo
 * @email   4ldrich@protonmail.com
 * @description
 * 
 * Class for Application Logs
 * 
 */
class Log
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
            case 'tail':
                // Cache purging
                $this->_tail();
                
                break;
            case 'purge':
                // Cache purging
                $this->_purge();
                
                break;
            default:
                // Nah...
                Console::error('Log commands: tail or purge');
                
                break;
        }
    }
    
    /**
     * Log Tail
     * 
     * @access  private
     * @return  void
     * 
     */
    private function _tail() {
        $log_path = spare(Config::get('log.folder'), LOLLIPOP_STORAGE_LOG);
        $log_enable = spare(Config::get('log.enable'), true);
        $log_hourly = spare(Config::get('log.hourly'), false);
        $filename = $log_path . DIRECTORY_SEPARATOR . ($log_hourly ? date('Y-m-d-H') : date('Y-m-d')) . '.log';
        
        $stored = file_get_contents($filename);
        
        while (1) {
            $stream = file_get_contents($filename);
            
            if ($stored != $stream) {
                $diff = str_replace($stored, '', $stream);
                $stored = $stream;
                echo $diff;
            }
            
            sleep(1);
        }
    }
    
    /**
     * Purge logs
     * 
     * @access  private
     * @return  void
     * 
     */
    private function _purge() {
        // Get all files from the cache folder
        $contents = glob(spare(Config::get('log.folder'), LOLLIPOP_STORAGE_LOG) . '*');

        // Remove cache files
        foreach ($contents as $content) {
            if (is_file($content)) {
                unlink($content);
            }
        }
    }
}
