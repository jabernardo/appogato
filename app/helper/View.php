<?php

use \Lollipop\Page;
use \Lollipop\Url;

/**
 * View Helper
 * 
 * @version     1.0
 * @author      John Aldrich Bernardo
 * @description Alias for \Lollipop\App;
 * 
 */
class View
{
    /**
     * Render alias
     * 
     * @param   string  $view   View file
     * @param   array   $data
     * @return  mixed
     * 
     */
    public static function render($view, array $data = array()) {
        return Page::render(APP_CORE_VIEW . $view, $data);
    }
    
    /**
     * Return base link
     * 
     * @param   string  $link
     * @return  string
     * 
     */
    public static function href($link) {
        return Url::base($link);
    }
}
