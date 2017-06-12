<?php

/**
 * Application Helper
 * 
 * @version     1.0
 * @author      John Aldrich Bernardo
 * @description Alias for \Lollipop\App;
 * 
 */
class App
{
    /**
     * Alias \Lollipop\App::getBenchmark()
     *
     * @return mixed
     *
     */
    public static function getBenchmark() {
        return (object)\Lollipop\App::getBenchmark();
    }
}
