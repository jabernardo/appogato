<?php

namespace App\Helper;

use \Lollipop\Config;

/**
 * Feature Switch Helper
 * 
 * @version     1.2
 * @author      John Aldrich Bernardo
 * @description Easy feature toggle using `switch` config
 * 
 */
class Feature
{
    /**
     * Checks if application feature is on
     * 
     * @access  public
     * @param   string  $key    Switch key
     * 
     */
    public function on($key) {
        return isset(Config::get('switch')->$key) && Config::get('switch')->$key;
    }
}
 