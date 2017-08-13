<?php

use \Lollipop\Config;
use \Lollipop\CsrfToken;
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
     * Pre-process node
     * 
     * @access  private
     * @param   ref &$node
     * 
     */
    private static function _process(&$node) {
        $attribs = '';
        
        // Add attributes
        if (isset($node['.']) && is_array($node['.'])) {
             foreach ($node['.'] as $key => $val) {
                 $attribs .= " $key=\"" . implode(' ', $val) . "\""; 
             }
             
             // Remove attributes key from widgets
             unset($node['.']);
        }
        
        return $attribs;
    }
    
    /**
     * Render structure
     * 
     * @access  public
     * @param   array   $struct
     * @return  string
     * 
     */
    public function render(array $struct) {
        // If has layout
        if (isset($this->view->layout) && is_array($this->view->layout)) {
            $this->view->layout['data'] = $this->_getViewData();
        }
        
        $data = $this->_getViewData();
        
        // Write content type
        $out = '<!doctype html><html>';
        
        // Build header
        foreach($struct as $section => $content) {
            if (is_array($content)) {
                // Inline attributes
                $out .= '<' . $section . self::_process($content) . '>';
                foreach ($content as $widget) {
                    if (is_string($widget)) {
                        $out .= Page::render(APP_CORE_VIEW . $widget . '.php', $data);
                    } else {
                        $out .= '<' . key($widget) . self::_process($widget) . '>';
                    }
                }
                $out .= '</' . $section . '>';
            } else {
                $w = Page::render(APP_CORE_VIEW . $content . '.php', $data);
                
                if ($w) {
                    $out .= '<' . $content . '>';
                    $out .= $w;
                    $out .= '</' . $content . '>';
                } else {
                    $out .= $w;
                }
            }
        }
        
        return $out . '</html>';
    }
}
