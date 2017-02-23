<?php

/**
 * Welcome Controller
 *
 * See `routes.php` on how this was working
 *
 */
class WelcomeController
{
    /**
     * Hello World!
     *
     */
    public function indexAction() {
        ViewHelper::render('hello.php');
    }
}
