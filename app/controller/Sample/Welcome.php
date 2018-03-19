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

        /**
         * Loading of models
         * 
         * $this->products = new \App\Model\Products();
         * 
         */
        
        /**
         * Loading of helpers
         *
         * $this->features = new \App\Helper\Feature();
         * 
         */
    }
    
    /**
     * Hello World!
     * 
     * @access  public
     * @param   \Lollipop\HTTP\Request  $req    HTTP Request Object
     * @param   \Lollipop\HTTP\Response $res    HTTP Response Object
     * @return  \Lollipop\HTTP\Response Response
     *
     */
    public function indexAction(\Lollipop\HTTP\Request $req, \Lollipop\HTTP\Response $res) {
        // Set page meta
        $this->view->title = 'Lollipop-PHP for MVC';
        $this->view->meta = [
            'author' => Config::get('app')->author,
            'description' => Config::get('app')->name,
            'keywords' => Config::get('app')->name
        ];

        // Set CSS data
        $this->view->css = [
            Url::base('static/css/normalize.css'),
            Url::base('static/css/skeleton.css'),
            Url::base('static/css/default.css')
        ];

        /**
         * JS to load
         * 
         * $this->view->js = [
         *       'https://code.jquery.com/jquery-3.2.1.min.js'
         *   ];
         * 
         */
        
        // Passing data to view
        $this->view->welcome_message = 'Up and Running!';
        
        // Start to render page
        return $this->render('welcome');
    }
}
