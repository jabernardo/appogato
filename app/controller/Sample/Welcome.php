<?php

namespace App\Controller\Sample;

use \Lollipop\Config;
use \Lollipop\Url;

/**
 * Welcome Controller
 *
 * See `routes.php` on how this was working
 *
 */
class Welcome extends \App\Controller\Core\Base
{
    /**
     * Class construct
     * 
     */
    function __construct() {
        // Call parent construct function
        parent::__construct();
    }
    
    /**
     * Hello World!
     *
     */
    public function indexAction(\Lollipop\HTTP\Request $req, \Lollipop\HTTP\Response $res) {
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
         
        /**
         * Loading of models
         * 
         * $products = new \LMVC\Model\Products()
         * 
         */
        
        /**
         * Loading of helpers
         * 
         * $features = new \LMVC\Helper\Feature()
         * 
         */
        
        // Passing data to view
        $this->view->welcome_message = 'Up and Running!';
        
        // Start to render page
        return $this->render('welcome');
    }
}
