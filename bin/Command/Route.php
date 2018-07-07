<?php

namespace App\Command;

use \Lollipop\Utils;

/**
 * Route Test Command
 * 
 * @version 1.0.0
 * @author  John Aldrich Bernardo <4ldrich@protonmail.com>
 * @package Appogato
 * 
 */
class Route implements \Console\Command {
    /**
     * Help Screen
     * 
     * @access  public
     * @param   \Console\Input      $i  Input
     * @param   \Console\Output     $o  Output
     * @return  void
     * 
     */
    private function _help(\Console\Input $i, \Console\Output $o) {
        $o->writeln('Appogato Route Tester' . PHP_EOL);
        
        // Test Route
        $o->writeln('-- Parameters --');
        $o->writeln(str_pad('uri', 15)      . 'Uri Path');
        $o->writeln(str_pad('method', 15)   . 'Request method');
        $o->writeln(str_pad('query', 15)    . 'Request quries');
        $o->writeln(str_pad('data', 15)     . 'Request data');
        
        $o->writeln('-- Example --');
        $o->writeln('./appogato route uri:/ query:"disable-debugger&message=test"');
        
        // --------
        $o->write(PHP_EOL);
    }
    
    /**
     * Invoke function
     *
     * @param   \Console\Input  $i
     * @param   \Console\Output $o
     * @return  void
     */
    function __invoke(\Console\Input $i, \Console\Output $o) {
        $one_param = count($i->getParameters()) === 1;
        
        if (in_array('help', $i->getParameters()) && $one_param) {
            // Help Screen
            $this->_help($i, $o);
        } else {
            // Get parameters from arguments
            $uri = Utils::spare($i->getOption('uri'), '/');
            $method = Utils::spare($i->getOption('method'), 'GET');
            $query = Utils::spare($i->getOption('query'), '');
            $data = Utils::spare($i->getOption('data'), null);
            $decoded = json_decode($data);
            
            if (!$decoded) {
                $decoded = [];
            }
            
            // Declare super globals in-order to emulate
            // web sapi
            $_SERVER = [];
            $_SERVER['REQUEST_URI'] = $uri;
            $_SERVER['SERVER_NAME'] = 'localhost';
            $_SERVER['SERVER_PORT'] = '80';
            $_SERVER['REQUEST_METHOD'] = strtoupper($method);
            $_SERVER['SCRIPT_NAME'] = 'index.php';
            
            $_REQUEST = [];
            $_REQUEST = Utils::array_merge($_REQUEST, $decoded);
            
            $queries = [];
            parse_str($query, $queries);
            $_GET = $queries;
            
            // Dispatch route
            $res = \Lollipop\HTTP\Router::dispatch(false);
            
            if (!($res instanceof \Lollipop\HTTP\Response))  {
                $res = new \Lollipop\HTTP\Response($res);
            }
            
            $res->compress(false);
            
            print_r($res->get(true));
        }
    }
}
