<?php

defined('APP_BIN') or exit('APP_BIN wasn\'t declared');

// Command-line colors
define('CF_BLACK',  "\033[30m");
define('CF_RED',    "\033[31m");
define('CF_GREEN',  "\033[32m");
define('CF_YELLOW', "\033[33m");
define('CF_BLUE',   "\033[34m");
define('CF_MAGENTA',"\033[35m");
define('CF_CYAN',   "\033[36m");
define('CF_WHITE',  "\033[37m");
define('CF_RESET',  "\033[39m");

/**
 * Console Message Writer
 * 
 * @package lmvc
 * @version 1.0
 * @author  John Aldrich Bernardo
 * @email   4ldrich@protonmail.com
 * 
 */
class Console
{
    /**
     * Log message
     * 
     * @access  public
     * @param   string  $message    Message
     * @return  void
     * 
     */
    public static function log($message) {
        echo CF_BLUE . '[INFO]' . CF_RESET . $message . CF_RESET . PHP_EOL;
    }
    
    /**
     * Success message
     * 
     * @access  public
     * @param   string  $message    Message
     * @return  void
     * 
     */
    public static function success($message) {
        echo CF_GREEN . '[SUCC]' . CF_RESET . $message . CF_RESET . PHP_EOL;
    }
    
    /**
     * Warning message
     * 
     * @access  public
     * @param   string  $message    Message
     * @return  void
     * 
     */
    public static function warn($message) {
        echo CF_YELLOW . '[WARN]' . CF_RESET . $message . CF_RESET . PHP_EOL;
    }
    
    /**
     * Error message
     * 
     * @access  public
     * @param   string  $message    Message
     * @param   bool    $terminate  Terminate application (default true)
     * @return  void
     * 
     */
    public static function error($message, $terminate = true) {
        echo CF_RED . '[ERROR] ' . CF_RESET . $message . CF_RESET . PHP_EOL;
        
        if ($terminate) exit(1);
    }
}
