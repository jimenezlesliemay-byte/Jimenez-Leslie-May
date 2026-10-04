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

// Migration Routes
$router->get('create-migration/{migration_class}', 'MigrationController::create_migration');
$router->get('migrate', 'MigrationController::migrate');
$router->get('rollback', 'MigrationController::rollback');
$router->get('rollback-all', 'MigrationController::rollback_all');
$router->get('refresh', 'MigrationController::refresh');
$router->get('status', 'MigrationController::status');

// ---------- API: auth (public) ----------
$router->match('/api/auth/register', 'ApiAuthController::register', 'POST|OPTIONS');
$router->match('/api/auth/login',    'ApiAuthController::login',    'POST|OPTIONS');
$router->match('/api/auth/refresh',  'ApiAuthController::refresh',  'POST|OPTIONS');
$router->match('/api/auth/logout',   'ApiAuthController::logout',   'POST|OPTIONS');

// ---------- API: products (JWT required) ----------
$router->group(['middleware' => 'jwt'], function ($router) {
    $router->match('/api/products',      'ApiProductController::index',   'GET|OPTIONS');
    $router->match('/api/products',      'ApiProductController::store',   'POST');
    $router->match('/api/products/{id}', 'ApiProductController::update',  'PUT|PATCH|OPTIONS');
    $router->match('/api/products/{id}', 'ApiProductController::destroy', 'DELETE');
});


