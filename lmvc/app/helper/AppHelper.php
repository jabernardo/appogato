<?php

use \Lollipop\App;

/**
 * Application Helper
 * 
 * @version     1.0
 * @author      John Aldrich Bernardo
 * @description Alias for \Lollipop\App;
 * 
 */
class AppHelper
{
    /**
     * Alias \Lollipop\App::getBenchmark()
     *
     * @return mixed
     *
     */
    public static function getBenchmark() {
        return (object)App::getBenchmark();
    }
}
