<?php

/**
 * Lollipop Debug
 * An extensive and flexible library for PHP
 *
 * @package    Lollipop for MVC
 * @version    1.3
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

use \Lollipop\Benchmark;
use \Lollipop\Config;
use \Lollipop\Log;
use \Lollipop\Page;
use \Lollipop\HTTP\Request;
use \Lollipop\HTTP\Router;
use \Lollipop\Session;
use \Lollipop\Url;

/**
 * Clean function
 * 
 */
Router::addMiddleware(function(\Lollipop\HTTP\Request $req, \Lollipop\HTTP\Response $res, Callable $next) {
    // Start Benchmark
    Benchmark::mark('_lmvc_start');

    $res = $next($req, $res);
    
    // End benchmark
    Benchmark::mark('_lmvc_stop');
    
    // Check if Debugger is enabled
    if (!Config::get('debugger')) return $res;
    if ($req->is('disable-debugger')) return $res;
    if (Session::get('disable-debugger')) {
        Session::drop('disable-debugger');
        return $res;
    }

    $is_html = false;
    $content_type_headers_count = 0;
    $raw_res = $res->get(true);

    foreach ($res->getHeaders() as $header) {
        // Check if text/html is set as header
        if (preg_match_all('/content-type:\s*text\/html/iU', $header)) {
            $is_html = true;
            break;
        }
    }
    
    $is_html = $is_html || (!is_array($raw_res) && !is_object($raw_res));
    
    if ($is_html) {
        $data = [];
        
        // Get application information
        $data['app'] = [
                'name' => 'Untitled Application',
                'version' => '1.0.0.0',
                'author' => 'Unknown'
            ];
        
        $config_app = Config::get('app');
        
        if (isset($config_app->name)) $data['app']['name'] = Config::get('app')->name;
        if (isset($config_app->version)) $data['app']['version'] = Config::get('app')->version;
        if (isset($config_app->author)) $data['app']['author'] = Config::get('app')->author;
        
        $data['app'] = (object)$data['app'];
        
        // Debugging Data
        $bm = (object)Benchmark::elapsed('_lmvc_start', '_lmvc_stop');
        
        $data['benchmark'] = (object)[
            'response' => (object) [
                    'time' => $bm->time_elapsed,
                    'memory_used' => $bm->real_memory_usage
                ]
        ];
        
        // Logs
        $data['logs'] = (object) Log::get();
        
        // Configuration
        $data['config'] = json_decode(json_encode(\Lollipop\Config::get()), true);
        
        // Session
        $data['session'] = Session::getAll();

        // Request
        $data['request'] = $req->get();

        // Route information
        $route = \Lollipop\HTTP\Router::getActiveRoute();
        
        if (!is_null($route) && !empty($route)) {
            $data['route'] = $route;
        }
        
        $debugger = Page::render(APP_CORE_DEBUG . 'summary.php', $data);
        
        // Output compression for debugger
        $res->set($res->get() . $debugger);

        if (Session::exists('debugger-compress-output')) {
            $res->compress(Session::get('debugger-compress-output'));
        }

        return $res;
    }
    
    return $res;
});
