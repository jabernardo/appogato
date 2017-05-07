<?php

/**
 * Lollipop Debug
 * An extensive and flexible library for PHP
 *
 * @package    Lollipop for MVC
 * @version    1.1
 * @author     John Aldrich Bernardo <bjohnaldrich@gmail.com>
 * @copyright  Copyright (C) 2015 John Aldrich Bernardo. All rights reserved.
 * @license
 *
 * Copyright (c) 2016 John Aldrich Bernardo
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, 
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR 
 * THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 */

use \Lollipop\App;
use \Lollipop\Config;
use \Lollipop\Page;
use \Lollipop\Request;
use \Lollipop\Route;
use \Lollipop\Session;
use \Lollipop\Url;

Route::clean(function() {
    // Check if Debugger is enabled
    if (!Config::get('debugger')) return false;
    if (Request::is('disable-debugger')) return false;
    if (Session::get('disable-debugger')) return false;

    $is_html = false;
    $content_type_headers_count = 0;

    foreach (headers_list() as $header) {
        // Check if text/html is set as header
        if (preg_match_all('/content-type:\s*text\/html/iU', $header)) {
            $is_html = true;
            break;
        }
        
        // Check for count of header with content-type
        if (preg_match_all('/content-type/iU', $header)) {
            $content_type_headers_count++;
        }
    }
    
    $is_html = $is_html || !$content_type_headers_count;
    
    if ($is_html) {
        $data = array();
        
        // Get application information
        $data['app'] = array(
                'name' => 'Untitled Application',
                'version' => '1.0.0.0',
                'author' => 'Unknown'
            );
        
        $config_app = Config::get('app');
        
        if (isset($config_app->name)) $data['app']['name'] = Config::get('app')->name;
        if (isset($config_app->version)) $data['app']['version'] = Config::get('app')->version;
        if (isset($config_app->author)) $data['app']['author'] = Config::get('app')->author;
        
        $data['app'] = (object)$data['app'];
        
        // Debugging Data
        $bm = (object)App::getBenchmark();
        
        $data['debug'] = array(
            'response' => (object)array(
                    'time' => $bm->time_elapsed,
                    'memory_used' => $bm->real_memory_usage
                )
        );
        $data['debug'] = (object)$data['debug'];
        
        
        exit(Page::render(APP_CORE_DEBUG . 'summary.php', $data));
    }
});
