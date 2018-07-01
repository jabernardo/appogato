<?php

namespace bin;

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
     * Invoke function
     *
     * @param   \Console\Input  $i
     * @param   \Console\Output $o
     * @return  void
     */
    function __invoke(\Console\Input $i, \Console\Output $o) {
        $uri = Utils::spare($i->getOption('uri'), '/');
        $method = Utils::spare($i->getOption('method'), 'GET');
        $data = Utils::spare($i->getOption('data'), null);
        $decoded = json_decode($data);
        
        if (!$decoded) {
            $decoded = [];
        }
        
        $_SERVER = [];
        $_SERVER['REQUEST_URI'] = $uri;
        $_SERVER['REQUEST_METHOD'] = strtoupper($method);
        $_SERVER['SCRIPT_NAME'] = 'index.php';
        
        $_REQUEST = [];
        $_REQUEST = Utils::array_merge($_REQUEST, $decoded);
        
        $res = \Lollipop\HTTP\Router::dispatch(false);
        
        if (!($res instanceof \Lollipop\HTTP\Response))  {
            $res = new \Lollipop\HTTP\Response($res);
        }
        
        $res->compress(false);
        
        print_r($res->get(true));
    }
}
