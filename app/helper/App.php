<?php

/**
 * Application Helper
 * 
 * @version     1.1
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
    public function getBenchmark() {
        return (object)\Lollipop\App::getBenchmark();
    }
}
