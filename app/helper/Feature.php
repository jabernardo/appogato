<?php

namespace App\Helper;

use \Lollipop\Config;
use \Lollipop\Utils;

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
        return Utils::spare_nan(Config::get('switch.' . $key), false) ? true : false;
    }
}
 