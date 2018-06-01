<?php

namespace App\Helper;

use \Lollipop\Config;
use \Lollipop\Security\CsrfToken;
use \Lollipop\DOM\Tag;
use \Lollipop\Text;
use \Lollipop\HTTP\Request;

/**
 * Form Helper
 * 
 * @version     1.0
 * @author      John Aldrich Bernardo
 * @description Form helper
 * 
 */
class Form
{
    /**
     * Create form
     *
     * @example 
     *  $form::create('registration')->contains(
     *      $form::input('username') .
     *      $form::submit()
     *  );
     * 
     * @param string $name      Form name
     * @param string $action    Form action
     * @param string $method    HTTP method (POST)
     * @param string $enctype   Encryption type (multipart/form-data)
     * @return \Lollipop\DOM\Tag
     */
    public static function create($name, $action = '', $method = 'POST', $enctype = 'multipart/form-data') {
        return Tag::create('form')
            ->add('name', $name)
            ->add('action', $action)
            ->add('method', $method)
            ->add('enctype', $enctype)
            ->contains(
                self::getAntiCsrfInput()
            );
    }

    /**
     * Create input
     *
     * @param string $name  Input name
     * @param string $value Input value
     * @param boolean $secured
     * @return \Lollipop\DOM\Tag
     */
    public static function input($name, $value = '', $secured = true) {
        return Tag::create('input')
            ->add('name', $secured ? Text::lock($name) : $name)
            ->add('value', $value);
    }

    /**
     * Get encrypted input value
     *
     * @param  string $name
     * @return string
     */
    public static function getSecuredInput($name) {
        $req = new Request();
        return $req->get(Text::lock($name));
    }

    /**
     * Get AntiCsrf Hidden Input
     *
     * @return \Lollipop\DOM\Tag
     */
    public static function getAntiCsrfInput() {
        return Tag::create('input')->add('type', 'hidden')->add('name', CsrfToken::getName())->add('value', CsrfToken::get());
    }

    /**
     * Submit button
     *
     * @param   string  $name   Submit button name
     * @return  \Lollipop\DOM\Tag
     */
    public static function submit($name) {
        return Tag::create('input', true)->add('type', 'submit')->add('name', $name);
    }
}
