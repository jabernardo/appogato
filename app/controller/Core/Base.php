<?php

namespace App\Controller\Core;

use \Lollipop\Config;
use \Lollipop\CsrfToken;
use \Lollipop\Log;
use \Lollipop\Page;
use \Lollipop\Request;
use \Lollipop\Url;

/**
 * Base Controller
 * 
 * @package Lollipop for MVC
 * @author  John Aldrich Bernardo
 * @version 1.0
 * 
 */
class Base
{
    /**
     * Class Construct
     * 
     */
    function __construct() {
        /**
         * @var     \stdClass    View variable holder
         * 
         */
        $this->view = new \stdClass();
        
        // Set all default view variables on class constuct
        $this->_setDefaultView();
        
        // Anti CSRF attacks
        $this->_hookCSRF();
    }
    
    /**
     * Set default view variables
     * 
     * @access  private
     * @return  void
     * 
     */
    private function _setDefaultView() {
        /**
         * @var string  Title
         * 
         */
        $this->view->title = Config::get('app')->name;
        
        /**
         * @var string  Page
         * 
         */
        $this->view->page = 'home';
        
        /**
         * @var array   JS Files
         * 
         */
        $this->view->js = array();
        
        /**
         * @var array   CSS Files
         * 
         * 
         */
        $this->view->css = array();

        /**
         * @var string  Domain name
         * 
         */
        $this->view->domain = Url::base();
        
        /**
         * @var string  Request URI
         * 
         */
        $this->view->request_uri = Url::here();
        
        /**
         * @var string  Csrf Token
         * 
         */
        $this->view->form = (object)array(
            'anti_csrf_input' => CsrfToken::getFormInput()
        );
    }
    
    /**
     * Check all passing request for CSRF attack
     * 
     * @access  private
     * @return  void
     * 
     */
    private function _hookCSRF() {
        $sugar = spare(Config::get('anti_csrf.name'), 'sugar');
        
        if ((isset($_POST) && count($_POST)) &&
            !CsrfToken::isValid(Request::get($sugar))) {
            
            $this->view->title = 'Lollipop-PHP for MVC';
            $this->view->meta = array(
                'author' => Config::get('app')->author,
                'description' => Config::get('app')->name,
                'keywords' => Config::get('app')->name
            );
            
            $this->view->css = array(
                Url::base('static/css/normalize.css'),
                Url::base('static/css/skeleton.css'),
                Url::base('static/css/default.css')
            );
            
            // Messages
            $this->view->title = 'No Trespassing';
            $this->view->message = 'Life is SHORT don\'t make it SHORTER.';
            
            exit($this->render('error'));
        }
    }
    
    /**
     * Generate data
     * 
     * @access  private
     * @return  array
     * 
     */
    private function _getViewData() {
        $d = array();
        
        // Build-up data
        foreach (get_object_vars($this->view) as $var => $val) {
            $d[$var] = $val;
        }
        
        return $d;
    }
    
    /**
     * Render structure
     * 
     * @access  public
     * @param   string   $struct
     * @return  string
     * 
     */
    public function render($page) {
        return Page::render(APP_CORE_VIEW . $page . '.php', $this->_getViewData());
    }
}
