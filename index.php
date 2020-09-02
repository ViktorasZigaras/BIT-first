<?php

/**
* Plugin Name: BIT First
* Plugin URI: https://www.yourwebsiteurl.com/
* Description: First.
* Version: 1.0
* Author: Your Name Here
* Author URI: http://yourwebsiteurl.com/
**/

use BIT\app\App;

// add_action('admin_menu', function() {
//     $app = App::start();
//     $routes = require $app->routeDir . 'adminRoute.php';
//     // $routes = require '../routes/adminRoute.php';
//     foreach ($routes as $path => $route) {
//         list($controller, $function) = explode('@', $route, 2);
//         add_menu_page(ucfirst($path) . ' Title', ucfirst($path) . ' Menu', 'manage_options', $path, 'render' . $controller . '_' . $function);
//     }
// });

function renderAdminController_index() {
    echo 'Admin <br>';
    $app = App::start();
    // print_r($app);
    echo '<br> ' . $app->routeDir;
}

function renderFrontController_index() {
    echo 'Front';
}

function renderApiController_index() {
    echo 'Api';
}

require_once __DIR__.'/vendor/autoload.php';

// use BIT\app\App;

App::start();