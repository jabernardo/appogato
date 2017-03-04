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
        return ViewHelper::render('hello.php');
    }
}
