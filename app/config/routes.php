<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/** @var object $router **/

$router->get('/users', 'UsersController::index');
$router->get('/users/create', 'UsersController::create');
$router->post('/users/store', 'UsersController::store');
$router->get('/users/edit/(:num)', 'UsersController::edit');
$router->post('/users/update/(:num)', 'UsersController::update');
$router->get('/users/delete/(:num)', 'UsersController::delete');


$router->get('/login', 'AuthController::login');
$router->post('/login', 'AuthController::authenticate');
$router->get('/logout', 'AuthController::logout');


$router->group(['middleware' => 'auth'], function($router) {
    $router->get('/products', 'ProductController::index');
    $router->get('/products/create', 'ProductController::create');
    $router->post('/products/store', 'ProductController::store');
    $router->get('/products/edit/{id}', 'ProductController::edit');
    $router->post('/products/update/{id}', 'ProductController::update');
    $router->get('/products/delete/{id}', 'ProductController::delete');
});