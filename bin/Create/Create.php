<?php

defined('APP_BIN') or exit('APP_BIN wasn\'t declared');

define('APP_BIN_CREATE', APP_BIN . 'Create/');
define('APP_BIN_CREATE_TEMPLATES', APP_BIN_CREATE . 'Templates/');

use \Lollipop\Config;

/**
 * Create Template
 * 
 * @package lmvc
 * @version 1.1
 * @author  John Aldrich Bernardo
 * @email   4ldrich@protonmail.com
 * @description
 * 
 * Class for generating LMVC template
 * 
 */
class Create
{
    /**
     * @var     array   Project config
     * 
     */
    private $_config = [];
    
    /**
     * @var     array   Command-line parameters
     * 
     */
    private $_args = [];
    
    /**
     * @var     string  Template name
     * 
     */
    private $_template = '';
    
    /**
     * @var     array   Flags 
     * 
     */
    private $_flags = [
            '-f' => false,
        ];
    
    /**
     * Class Construct
     * 
     * @param   array   Project config
     * @param   array   Parameters
     * @return  void
     * 
     */
    function __construct(array $args) {
        $this->_config = [
                'package' => spare(Config::get('app.name'), 'Application Name'),
                'version' => spare(Config::get('app.version'), '1.0'),
                'author' => spare(Config::get('app.author'), 'Programmer'),
                'email' => spare(Config::get('app.email'), 'youremail@domain.ext')
            ];
            
        $this->_args;
        $this->_template = isset($args[0]) ? $args[0] : '';
        
        $template_conf = $this->_parseTemplateConfig();
    
        
        if (!isset($template_conf[$this->_template])) {
            Console::error('Unknown template.');
        }
        
        $template = $template_conf[$this->_template]['template'];
        
        // Remove template name from array
        $args = array_splice($args, 1, count($args) - 1);
        
        if (!count($args)) {
            Console::error('Missing names.');
        }
        
        // Get output name
        $name = $args[0];
        
        // Override name
        $data = [
                    'vars' => [
                        'name' => $name
                    ]
                ];
        
        // Parameters
        $args = array_splice($args, 1, count($args) - 1);
        
        // Flags
        foreach ($args as $arg) {
            $key = $arg;
            
            if (isset($this->_flags[$key])) {
                $this->_flags[$key] = true;
            } else {
                Console::error('Unknown flag: ' . $arg);
            }
        }
        
        
        // File path
        $file = APP_CORE . $template_conf[$this->_template]['path'] . $name . '.php';
        
        // Write file
        $this->_writeTemplate($file, $this->_parseTemplate($template, $data));
    }
    
    /**
     * File write
     * 
     * @access  private
     * @param   string  $file   File path
     * @param   string  $content    Template content
     * 
     */
    private function _writeTemplate($file, $content) {
        $overwrite = $this->_flags['-f'];
        
        if (file_exists($file) && !$overwrite) {
            Console::error('File already exists: ' . $file);
        }
        
        file_put_contents($file, $content);
    }
    
    /**
     * Parse template
     * 
     * @access  private
     * @param   string  $template   Template name
     * @param   array   $config     Dynamic variables
     * @return  string
     * 
     */
    private function _parseTemplate($template, array $config) {
        $data = '';

        if (file_exists(APP_BIN_CREATE_TEMPLATES . $template)) {
            $data = file_get_contents(APP_BIN_CREATE_TEMPLATES . $template);
        }
        
        $vals = $this->_parseTemplateConfig();
        
        $vals = array_merge_recursive($config, $vals);
        
        return $this->_parseTemplateVars($data, $vals);
    }
    
    /**
     * Parse template
     * 
     * @access  private
     * @param   string  $template   Template name
     * @param   array   $vars       Var
     * 
     */
    private function _parseTemplateVars($template, array $vars) {
        foreach ($vars as $key => $val) {
            if (is_array($val)) {
                $template = $this->_parseTemplateVars($template, $val);
            } else {
                $template = str_replace('{' . $key . '}', $val, $template);
            }
        }
        
        return $template;
    }
    
    /**
     * Parse templates config to change values
     * of dynamic variables
     * 
     */
    private function _parseTemplateConfig() {
        if (!file_exists(APP_BIN_CREATE_TEMPLATES . 'config.json')) return [];
        
        $config = json_decode(file_get_contents(APP_BIN_CREATE_TEMPLATES . 'config.json'), true);
        
        if (!$config) return [];
        
        return $this->_parseTemplateConfigValues($config);
    }
    
    /**
     * Replace $ from templates config with values from
     * project config
     * 
     * @access  private
     * @param   array   $array  Array
     * @return  array
     * 
     */
    private function _parseTemplateConfigValues(array $array) {
        $array = $array;
        
        foreach ($array as $key => &$val) {
            if (is_array($val)) {
                $val = $this->_parseTemplateConfigValues($val);
            } else {
                if ($val == '$') {
                    $val = isset($this->_config[$key]) ? $this->_config[$key] : "{" . $key . "}";
                }
            }
        }
        
        return $array;
    }
}
