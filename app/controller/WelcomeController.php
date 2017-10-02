<?php

use \Lollipop\Config;
use \Lollipop\Url;

/**
 * Welcome Controller
 *
 * See `routes.php` on how this was working
 *
 */
class WelcomeController extends BaseController
{
    /**
     * Class construct
     * 
     */
    function __construct() {
        // Call parent construct function
        parent::__construct();
        
        /**
         * Loading Helpers
         * 
         *  $this->load('Feature');
         *  $this->helpers->Feature->on('feature-name')
         * 
         */
        
        /**
         * Loading Models
         * 
         *  $this->load('Message');
         *  $this->Message->get();
         * 
         * or you could declare a new alias
         * 
         *  $this->load('Message', 'm');
         *  $this->m->get();
         * 
         */
    }
    
    /**
     * Hello World!
     *
     */
    public function indexAction() {
        // Set page meta
        $this->view->title = 'Lollipop-PHP for MVC';
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

        /**
         * JS to load
         * 
         * $this->view->js = array(
         *       'https://code.jquery.com/jquery-3.2.1.min.js'
         *   );
         * 
         */
        
        // Passing data to view
        $this->view->welcome_message = 'Up and Running!';
        
        // Start to render page
        return $this->render('template');
    }
}
