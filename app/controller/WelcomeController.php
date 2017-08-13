<?php

use \Lollipop\Config;

/**
 * Welcome Controller
 *
 * See `routes.php` on how this was working
 *
 */
class WelcomeController extends BaseController
{
    /**
     * Hello World!
     *
     */
    public function indexAction() {
        // Set page meta
        $this->view->title = 'Lollipop-PHP for MVC';
        $this->view->meta = array(
            'author' => Config::get('app')->author,
            'description' => Config::get('app')->name,
            'keywords' => Config::get('app')->name
        );

        // Set CSS data
        $this->view->css = array(
            View::href('static/css/default.css')
        );

        // JS to load
        $this->view->js = array(
            View::href('static/js/jquery-3.2.0.min.js'),
            View::href('static/js/default.js')
        );

        // Start to render page
        return $this->render(
                array( // Your Page
                    'head' => array( // Head section
                        'default/meta' // Default meta widget
                    ),
                    'body' => array( // Body
                        'hello',        // app/view/hello.php
                        'default/css',  // app/view/default/css.php
                        'default/js'    // app/view/default/js.php
                    )
                )
            );
    }
}
