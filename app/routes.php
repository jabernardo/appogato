<?php

/**
 * Application Routes
 *
 *
 */

use \Lollipop\Route;

/**
 * Index Page using Controller
 *
 */
Route::all('/', 'WelcomeController.indexAction', true);
