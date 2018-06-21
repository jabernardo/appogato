<?php

namespace App\Middleware;

/**
 * En-force JSend Specification
 * 
 * @package appogato
 * @author  John Aldrich Bernardo <4ldrich@protonmail.com>
 * 
 */
class JSend implements \Lollipop\HTTP\Middleware
{
    /**
     * Middleware Handler
     * 
     * @access  public
     * @param   \Lollipop\HTTP\Request  $req    Request object
     * @param   \Lollipop\HTTP\Response $res    Response object
     * @return  \Lollipop\HTTP\Response
     * 
     */
    public function __invoke(\Lollipop\HTTP\Request $req, \Lollipop\HTTP\Response $res, Callable $next) {
        // Call the controller first
        $res = $next($req, $res);
        
        // Get raw data from response object
        $raw = $res->get(true);
        
        // If raw data wasn't an array or object then
        // Return the original response
        if (!is_array($raw) && !is_object($raw)) return $res;
        
        // Make sure it was an array
        $raw = (array)$raw;
        
        // Get overrides from raw object for `status` and `message`
        $status = strtolower(isset($raw['status']) ? $raw['status'] : 'success');
        $message = isset($raw['message']) ? $raw['message'] : 'no message specified';
        
        // Remove the `status` and `message` from data of response
        if (isset($raw['status'])) unset($raw['status']);
        if (isset($raw['message'])) unset($raw['message']);
        
        $formatted = [
                'status' => $status,
                'message' => $message,
                'data' => $raw
            ];
            
        // Make sure we don't send any data to the response once error was triggered
        if ($status === 'error') unset($formatted['data']);
        
        // Return formatted JSend response data
        return $res->set($formatted);
    }
}
