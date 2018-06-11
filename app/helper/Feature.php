<?php

namespace App\Helper;

use \Lollipop\Config;

/**
 * Feature Switch Helper
 * 
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
    public static function on($key) {
        return spare_nan(Config::get('switch.' . $key), false) ? true : false;
    }
}
 