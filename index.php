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

// 'admin' => 'AdminController@index',
function renderAdminController_index()
{
    echo PLUGIN_DIR_URL . '<br>';
    echo '
        <br>
        <button id="editButton"> Click </button>
    ';

    echo "<script language='javascript'>
        const editButton = document.querySelector('#editButton');
        // console.log(editButton);
        // console.log('JS');
        if (editButton) {
            editButton.addEventListener('click', () => { 
                console.log('clicked');
                axios.get('" . PLUGIN_DIR_URL . "/api?route=test'
                // , {route: 'test'}
                )
                // get can also have params
                .then((response) => {  
                    console.log(response);
                    console.log(response.data);
                    console.log(response.data.a);
                    // displayMessages(response.data);
                    // drawIndexInit();
                })
                .catch((error) => {
                    console.log(error);
                    // displayErrorMessages(error.response.data.errors);
                });
            });
        }
    </script>";
}

App::start();