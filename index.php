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
                axios.get('http://localhost/wordpress/wp-content/plugins/BIT-first/api/'), 
                {route: test}
                // get can also have params
                .then((response) => {  
                    console.log(response);
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










use BIT\app\Config;
Config::postTypeRegister();
use BIT\app\Post;
use BIT\models\AlbumPost;
use BIT\models\IdeaPost;
use BIT\models\NewsPost;
use BIT\models\EventPost;
echo'----------------------------';
$post = AlbumPost::get(288);
// $post->post_title = 'nauja rGGGGGGGGGGGGG';
// $post->event_description = 'nauja 0GGGGGG99';
var_dump($post);
// echo '<br><br>';

// $post->save();







