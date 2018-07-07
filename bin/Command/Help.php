<?php

namespace App\Command;

use \Lollipop\Utils;

/**
 * Help Command
 * 
 * @version 1.0.0
 * @author  John Aldrich Bernardo <4ldrich@protonmail.com>
 * @package Appogato
 * 
 */
class Help implements \Console\Command {
    /**
     * Application container
     * 
     */
    private $app;
    
    /**
     * Class construct
     * 
     * 
     */
    function __construct($app) {
        $this->app = $app;
    }
    
    /**
     * Invoke function
     *
     * @param   \Console\Input  $i
     * @param   \Console\Output $o
     * @return  void
     */
    function __invoke(\Console\Input $i, \Console\Output $o) {
        $o->writeln('[Appogato Commands]' . PHP_EOL);

        foreach ($this->app->getCommands() as $cmd) {
            $o->writeln(' - ' . $cmd);
        }
        
        $o->writeln(PHP_EOL . 'Use `appogato [command] help` for specific command help screen');
        $o->writeln('    ex. `appogato cache help`');
        
        $o->write(PHP_EOL);
    }
}
