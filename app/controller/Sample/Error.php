<?php

namespace App\Controller\Sample;

use \Lollipop\Config;
use \Lollipop\HTTP\URL;

/**
 * ErrorController Controller
 * 
 * @package     Lollipop Sample App
 * @version     1.0
 * @author      Programmer
 * @email       youremail@domain.ext
 * 
 */
class Error extends \App\Controller\Core\Base
{
    /**
     * Class construct
     * 
     * @access  public
     * @return  void
     * 
     */
    function __construct() {
        // Call parent construct function
        parent::__construct();
    }
    
    /**
     * 404 Page Not Found Action
     * 
     * @access  public
     * @return  void
     * 
     */
    public function pagenotfoundAction() {
        // Set page meta
        $this->view->title = '404 Page Not Found';
        $this->view->meta = [
            'author' => Config::get('app')->author,
            'description' => Config::get('app')->name,
            'keywords' => Config::get('app')->name
        ];

        $this->view->favicon = URL::base('static/img/favicon.ico');

        // Set CSS data
        $this->view->css = [
            URL::base('static/css/normalize.css'),
            URL::base('static/css/skeleton.css'),
            URL::base('static/css/default.css')
        ];
        
        // Messages
        $this->view->title = 'Page Not Found';
        $this->view->message = 'The page that you have requested could not be found.';
        
        // Set 404 header
        $this->headers = [
            'HTTP/1.0 404 Not Found'
        ];

        // @todo    Insert actions here
        return $this->render('error');
    }
}
