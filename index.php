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

use BIT\app\Config;
Config::postTypeRegister();

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
                axios.get('http://localhost:8888/wordpress/wp-content/plugins/BIT-first/api/?route=test'
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


use BIT\models\NewsPost;

function renderNewsController_index()
{
    // echo count(get_posts()) . ' count <br><br>';

    // $posts = get_posts([
    //     'post_type' => 'News',
    //     'post_status' => 'publish',
    //     'numberposts' => -1
    //     // 'order'    => 'ASC'
    // ]);

        $posts = NewsPost::all();
        var_dump($posts);

        // ::get($post_id) - grazins jusu objekta.
        // ::all() - grazins masyva is visu to tipo objektu.

    foreach ($posts as $post) {

        echo '<br>
            <div class="lenteles">
            <form class="forma" method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="news_update" value="update news">
                <input type="hidden" name="news_id" value="' . $post->ID . '">
                <div class="form-group">
                    <label class="admin-label">Data</label><br>
                    <input type="text" name="date" value="' . $metas['date'][0] . '" class="admin-input">
                </div>
                <div class="form-group">
                    <label class="admin-label">Įrašas</label><br>
                    <input type="text" name="record" value="' . $metas['content'][0] . '" class="admin-input">
                </div>
                <div class="mygtukai">
                    <button type="submit" class="admin-button">Redaguoti</button>
                    </form>
                    <form method="POST" action="">
                    <div class="mygtukai">
                            <input type="hidden" name="news_delete" value="news_id">
                            <input type="hidden" name="news_id" value="' . $post->ID . '">
                            <button type="submit" class="admin-button">Trinti</button>
                        </div>
                    </form>
                </div>
        </div>
        <br>';

}

        echo '<br>
            <div class="lenteles">
                <form class="forma" method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="news_new" value="new news">
                    <div class="form-group">
                        <label class="admin-label">Data</label><br>
                        <input type="text" name="date" value="date" class="admin-input">
                    </div>
                    <div class="form-group">
                        <label class="admin-label">Įrašas</label><br>
                        <input type="text" name="content" value="content" class="admin-input">
                    </div>
                    <div class="mygtukai">
                        <button type="submit" class="admin-button">Pridėti</button>
                </form>
                    </div>
            </div>
        <br>';
}

function renderPhilosophyController_index()
{
    // echo count(get_posts()) . ' count <br><br>';

    // $posts = get_posts([
    //     'post_type' => 'Philosophy',
    //     'post_status' => 'publish',
    //     'numberposts' => -1
    //     // 'order'    => 'ASC'
    // ]);

    // foreach ($posts as $post) {
    //     $metas = get_post_metas($post->ID);

        // ::get($post_id) - grazins jusu objekta.
        // ::all() - grazins masyva is visu to tipo objektu.


//         echo '<br>
//             <div class="lenteles">
//             <form class="forma" method="POST" action="" enctype="multipart/form-data">
//                 <input type="hidden" name="philosophy_update" value="update philosophy">
//                 <input type="hidden" name="philosophy_id" value="' . $post->ID . '">
//                 <div class="form-group">
//                     <label class="admin-label">Vizija</label><br>
//                     <input type="text" name="vision" value="' . $metas['vision'][0] . '" class="admin-input">
//                 </div>
//                 <div class="form-group">
//                     <label class="admin-label">Misija</label><br>
//                     <input type="text" name="mission" value="' . $metas['mission'][0] . '" class="admin-input">
//                 </div>
//                 <div class="mygtukai">
//                     <button type="submit" class="admin-button">Redaguoti</button>
//                     </form>
//                     <form method="POST" action="">
//                     <div class="mygtukai">
//                             <input type="hidden" name="philosophy_delete" value="philosophy_id">
//                             <input type="hidden" name="philosophy_id" value="' . $post->ID . '">
//                             <button type="submit" class="admin-button">Trinti</button>
//                         </div>
//                     </form>
//                 </div>
//         </div>
//         <br>';

// }
//         echo '<br>
//             <div class="lenteles">
//                 <form class="forma" method="POST" action="" enctype="multipart/form-data">
//                     <input type="hidden" name="philosophy_new" value="new philosophy">
//                     <div class="form-group">
//                         <label class="admin-label">Vizija</label><br>
//                         <input type="text" name="vision" value="vision" class="admin-input">
//                     </div>
//                     <div class="form-group">
//                         <label class="admin-label">Misija</label><br>
//                         <input type="text" name="mission" value="mission" class="admin-input">
//                     </div>
//                     <div class="mygtukai">
//                         <button type="submit" class="admin-button">Pridėti</button>
//                 </form>
//                     </div>
//             </div>
//         <br>';
 }


App::start();