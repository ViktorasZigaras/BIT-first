<?php

/**
 * Plugin Name: BIT First
 * Plugin URI: https://www.yourwebsiteurl.com/
 * Description: First.
 * Version: 1.0
 * Author: Your Name Here
 * Author URI: http://yourwebsiteurl.com/
 **/

require_once __DIR__.'/vendor/autoload.php';

define('PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

use BIT\app\App;

add_action('admin_menu', function () {
    $app = App::start();
    $routes = require 'routes/adminRoute.php';
    foreach ($routes as $path => $route) {
        list($controller, $function) = explode('@', $route, 2);
        add_menu_page(ucfirst($path) . ' Title', ucfirst($path) . ' Menu', 'manage_options', $path, 'render' . $controller . '_' . $function);
    }
});

function renderAdminController_index()
{
    $app = App::start();
    echo '<div>ADMIN</div>';
}

function renderFrontController_index()
{
    echo 'Front';
}

function renderApiController_index()
{
    echo 'Api';
}

$app = App::start();
