<?php

namespace App\Controller\API;

use \Lollipop\Cache;
use \Lollipop\Utils;

/**
 * Sample API Implementation
 * 
 * @package appogato
 * @author  John Aldrich Bernardo <4ldrich@protonmail.com>
 * 
 */
class Sample
{
    /**
     * Get saved message
     * 
     * @access  public
     * @param   \Lollipop\HTTP\Request  $req    Request Object
     * @param   \Lollipop\HTTP\Response $res    Response Object
     * @param   array                   $args
     * @return  \Lollipop\HTTP\Response
     * 
     */
    public function get(\Lollipop\HTTP\Request $req, \Lollipop\HTTP\Response $res, $args = []) {
        $message = Utils::spare(Cache::get('api_test_message'), 'Hello World!');
        
        return $res->set(['message' => $message]);
    }
    
    /**
     * Change saved message
     * 
     * @access  public
     * @param   \Lollipop\HTTP\Request  $req    Request Object
     * @param   \Lollipop\HTTP\Response $res    Response Object
     * @param   array                   $args
     * @return  \Lollipop\HTTP\Response
     * 
     */
    public function set(\Lollipop\HTTP\Request $req, \Lollipop\HTTP\Response $res, $args = []) {
        $status = Cache::save('api_test_message', Utils::spare($req->get('message'), 'Hello World!'), true);
        $stat = $status ? 'success' : 'error';
        $msg = $status ? 'saved' : 'cannot saved';
        
        return $res->set(['status' => $stat, 'message' => $msg]);
    }
}
