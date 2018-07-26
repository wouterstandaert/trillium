<?php

// Load functionality
require_once './vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();
// Set default namespace
$router->setNamespace('\App\Controllers');
// Display the dashboard
$router->get('install', 'InstallController@showInstall');
// Display the dashboard
$router->get('login', 'LoginController@showLogin');
// Display the dashboard
$router->get('dashboard', 'DashboardController@showDashboard');

$router->mount('/users', function() use ($router) {

    // Get a list of users
    $router->get('', 'UserController@showUsers');


    $router->get('/user', function() use ($router) {
        // Get a list of users
        $router->get('', 'UserController@showUser');
        // Get a single user
        $router->get('/(\d+)', 'UserController@showUser');
    });

});


$router->mount('/pages', function() use ($router) {

    // Get a list of users
    $router->get('', 'PageController@showPages');

});

$router->mount('/products', function() use ($router) {

    // Display a list of products
    $router->get('', 'ProductController@showProducts');
    // Display a list of products
    $router->get('/categories', 'ProductController@showCategories');
    // Display a list of models
    $router->get('/models', 'ProductController@showModels');

});

// Set a fallback
//$router->set404('\App\Controllers\DashboardController@showDashboard');

// Start your engine
$router->run();