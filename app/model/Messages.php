<?php

namespace App\Model;

/**
 * Messages Model
 * 
 * *THIS IS A SAMPLE MODEL*
 * 
 * @package appogato
 * @author  John Aldrich Bernardo <4ldrich@protonmail.com>
 * 
 */
class Messages
{
    /**
     * @var array   Messages collection
     * @access  private
     * 
     */
    private $message = [
            'up' => 'Up and Running!',
            'hello' => 'Hello World!'
        ];
    
    
    /**
     * Get message
     * 
     * @access  public
     * @param   string  $message    Message key
     * @return  string
     * 
     */
    public function get($message) {
        return fuse($this->message[$message], $this->message['hello']);
    }
}
