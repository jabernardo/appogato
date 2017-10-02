<?php

use \Lollipop\Config;
use \Lollipop\CsrfToken;
use \Lollipop\Log;
use \Lollipop\Page;
use \Lollipop\Url;

/**
 * Base Controller
 * 
 */
class BaseController
{
    /**
     * Class Construct
     * 
     */
    function __construct() {
        $this->view = new stdClass();
        $this->helpers = new stdClass();
        $this->_setDefaultView();
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
        $this->view->form = array(
            'anti_csrf_input' => CsrfToken::getFormInput()
        );
    }
    
    /**
     * Generate data
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
     * Load Models or Helpers
     * 
     * @access  public
     * @param   string  $name   Name to load
     * @param   string  $alias  Alias for loaded class
     * @return  void
     * 
     */
    public function load($name, $alias = null) {
        $f = false;
        
        // Load models
        if (file_exists(APP_CORE_MODEL . $name . '.php')) {
            require_once(APP_CORE_MODEL . $name . '.php');
            $f = true;
            
            if ($alias) {
                $this->{$alias} = new $name();
            } else {
                $this->{$name} = new $name();
            }
        }
       
        // Load helpers
        if (file_exists(APP_CORE_HELPER . $name . '.php')) {
            require_once(APP_CORE_HELPER . $name . '.php');
            $f = true;
            
            if ($alias) {
                $this->{$alias} = new $name();
            } else {
                $this->helpers->{$name} = new $name();
            }
        }
        
        if (!$f) {
            Log::error('Tried to load non-existent: ' . $name);
        }
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
