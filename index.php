<?php

// Load functionality
require_once './vendor/autoload.php';

error_reporting(E_ALL);

// Create Router instance
$router = new \Bramus\Router\Router();
// Set default namespace
//$router->setNamespace('\App\Controllers');
// Display the dashboard
$router->get('install', 'App\Controllers\InstallController@showInstall');
// Display the dashboard
$router->get('login', 'App\Controllers\LoginController@showLogin');
// Display the dashboard
$router->get('dashboard', 'App\Controllers\DashboardController@showDashboard');
$router->post('dashboard', 'App\Controllers\DashboardController@handleConfig');

$router->mount('/users', function() use ($router) {

    // Get a list of users
    $router->get('', 'App\Controllers\UserController@showUsers');


    $router->get('/user', function() use ($router) {
        // Get a list of users
        $router->get('', 'App\Controllers\UserController@showUser');
        // Get a single user
        $router->get('/(\d+)', 'App\Controllers\UserController@showUser');
    });

});


$router->mount('/pages', function() use ($router) {

    // Get a list of users
    $router->get('', 'App\Controllers\PageController@showPages');

});

$router->mount('/products', function() use ($router) {

    $router->mount('/product', function() use ($router) {

        $router->get('', 'App\Controllers\ProductController@showProduct');
        $router->post('', 'App\Controllers\ProductController@handleProduct');
        $router->post('/(\d+)', 'App\Controllers\ProductController@showProduct');
    });

    // Display a list of products
    $router->get('', 'App\Controllers\ProductController@showProducts');
    // Display a list of products
    $router->get('/categories', 'App\Controllers\ProductController@showCategories');
    // Display a list of models
    $router->get('/models', 'App\Controllers\ProductController@showModels');
});

$router->mount('/customers', function() use ($router) {
    // Display a list of products
    $router->get('', 'App\Controllers\CustomerController@showCustomers');
});

$router->mount('/projects', function() use ($router) {
    // Display a list of products
    $router->get('', 'App\Controllers\ProjectController@showProjects');
});

// Set a fallback
//$router->set404('\App\Controllers\DashboardController@showDashboard');

// Start your engine
$router->run();