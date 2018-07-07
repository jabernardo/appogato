<?php

namespace App\Command;

/**
 * Cache Command
 * 
 * @version 1.0.1
 * @author  John Aldrich Bernardo <4ldrich@protonmail.com>
 * @package Appogato
 * 
 */
class Cache implements \Console\Command {
    /**
     * Purge cache
     *
     * @acess   private
     * @param   \Console\Input  $i
     * @param   \Console\Output $o
     * @return  void
     */
    private function _purge(\Console\Input $i, \Console\Output $o) {
        $o->writeln('[Cache] Start purging...');
        \Lollipop\Cache::purge();
        $o->writeln('[Cache] Purging done.');
    }

    /**
     * Save cache
     *
     * @access  private
     * @param   \Console\Input  $i
     * @param   \Console\Output $o
     * @return  void
     */
    private function _save(\Console\Input $i, \Console\Output $o) {
        foreach($i->getOptions() as $key => $val) {
            $o->writeln('[Cache] Creating "%s"...', $key);
            \Lollipop\Cache::save($key, $val);
            $o->writeln('[Cache] Saved "%s".', $key);
        } 
    }

    /**
     * Remove cache
     *
     * @access  private
     * @param   \Console\Input  $i
     * @param   \Console\Output $o
     * @return  void
     */
    private function _remove(\Console\Input $i, \Console\Output $o) {
        foreach($i->getParameters() as $key) {
            $o->writeln('[Cache] Removing cache "%s"...', $key);
            \Lollipop\Cache::remove($key);
            $o->writeln('[Cache] Removed cache "%s"', $key);
        }
    }

    /**
     * Get cache value
     *
     * Flags:
     *  - s : Serialize value
     * 
     * @access  private
     * @param   \Console\Input  $i
     * @param   \Console\Output $o
     * @return  void
     */
    private function _get(\Console\Input $i, \Console\Output $o) {
        $index = 0; // Key index
        
        foreach($i->getParameters() as $key) {
            // Display value for cache key
            // [{key}]
            // {value}

            $value = \Lollipop\Cache::get($key);

            if ($i->hasFlag('s')) {
                // Force serialization
                $value = serialize($value);
            }

            if (is_null($value)) {
                $value = '(NULL)';
            } if (is_object($value)) {
                $value = serialize($value);
            }

            $o->writeln("[%s]\n%s\n", $key, $value);
            
            $i++;
        }
    }

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
        $o->writeln('Appogato Cache Control' . PHP_EOL);
        // Save cache
        $o->writeln(str_pad('-s key:val', 15) . 'Save cache');
        $o->writeln('    ex. appogato cache -s message:hello');
        // Get cache value
        $o->writeln(str_pad('-v key ...', 15) . 'Get cache value');
        $o->writeln('    ex. appogato cache -v message');
        // Remove cache
        $o->writeln(str_pad('-x key ...', 15) . 'Remove cache');
        $o->writeln('    ex. appogato cache -x message');
        // Cache purge
        $o->writeln(str_pad('purge', 15) . 'Cache purge');
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
        
        if ($i->hasFlag('s')) {
            $this->_save($i, $o);
        } else if ($i->hasFlag('v')) {
            $this->_get($i, $o);
        } else if ($i->hasFlag('x')) {
            $this->_remove($i, $o);
        } else if (in_array('purge', $i->getParameters()) && $one_param) {
            $this->_purge($i, $o);
        } else if (in_array('help', $i->getParameters()) && $one_param) {
            $this->_help($i, $o);
        } else {
            $o->writeln('[Cache] Command not found.');
        }
    }
}
