<?php

use \Lollipop\Config;
use \Lollipop\Url;

/**
 * ErrorController Controller
 * 
 * @package     Lollipop Sample App
 * @version     1.0
 * @author      Programmer
 * @email       youremail@domain.ext
 * 
 */
class ErrorController extends BaseController
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
        $this->view->meta = array(
            'author' => Config::get('app')->author,
            'description' => Config::get('app')->name,
            'keywords' => Config::get('app')->name
        );

        // Set CSS data
        $this->view->css = array(
            Url::base('static/css/normalize.css'),
            Url::base('static/css/skeleton.css'),
            Url::base('static/css/default.css')
        );
        
        // Messages
        $this->view->title = 'Page Not Found';
        $this->view->message = 'The page that you have requested could not be found.';
        
        // @todo    Insert actions here
        return $this->render('404');
    }
}
