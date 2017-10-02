<?php

use \Lollipop\Config;

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
        
        // Load view helper
        $this->load('View');
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
            $this->helpers->View->href('static/css/normalizet.css'),
            $this->helpers->View->href('static/css/skeleton.css'),
            $this->helpers->View->href('static/css/default.css')
        );

        /**
         * JS to load
         * 
         * $this->view->js = array(
         *       'https://code.jquery.com/jquery-3.2.1.min.js'
         *   );
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
        
        // Passing data to view
        $this->view->version = Config::get('app')->version;
        
        // Start to render page
        return $this->render('template');
    }
}
