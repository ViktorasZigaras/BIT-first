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
// require_once __DIR__.'/app/App.php';

use BIT\app\App;

add_action('admin_menu', function() {
    // add_menu_page('Title', 'Menu', 'manage_options', 'Path', 'render_event_function');

    $app = App::start();
    // 'admin' => 'AdminController@index'
    // echo $app->routeDir;
    // $routes = require $app->routeDir . 'adminRoute.php';
    $routes = require 'routes/adminRoute.php';
    foreach ($routes as $path => $route) {
        list($controller, $function) = explode('@', $route, 2);
        add_menu_page(ucfirst($path) . ' Title', ucfirst($path) . ' Menu', 'manage_options', $path, 'render' . $controller . '_' . $function);
    }

    // add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null );
    // add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', int $position = null );

    // add_submenu_page('bebras', 'Page title 2', 'Menu title 2', 'manage_options', 'bebras2', 'bebro_funkcija2');
    // add_submenu_page('bebras', 'Edit', null, 'manage_options', 'bebras3', 'bebro_funkcija3');
});

function renderAdminController_index() {
    echo 'Admin <br>';
    $app = App::start();
    print_r($app);
    echo '<br> ' . $app->routeDir;
}

function renderFrontController_index() {
    echo 'Front';
}

function renderApiController_index() {
    echo 'Api';
}

function renderNewsController_index()
{
    // echo count(get_posts()) . ' count <br><br>';

    $posts = get_posts([
        'post_type' => 'News',
        'post_status' => 'publish',
        'numberposts' => -1
        // 'order'    => 'ASC'
    ]);

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
                    <input type="text" name="record" value="' . $metas['record'][0] . '" class="admin-input">
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
                        <input type="text" name="record" value="record" class="admin-input">
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

    $posts = get_posts([
        'post_type' => 'Philosophy',
        'post_status' => 'publish',
        'numberposts' => -1
        // 'order'    => 'ASC'
    ]);

    foreach ($posts as $post) {

        echo '<br>
            <div class="lenteles">
            <form class="forma" method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="philosophy_update" value="update philosophy">
                <input type="hidden" name="philosophy_id" value="' . $post->ID . '">
                <div class="form-group">
                    <label class="admin-label">Vizija</label><br>
                    <input type="text" name="vision" value="' . $metas['vision'][0] . '" class="admin-input">
                </div>
                <div class="form-group">
                    <label class="admin-label">Misija</label><br>
                    <input type="text" name="mission" value="' . $metas['mission'][0] . '" class="admin-input">
                </div>
                <div class="mygtukai">
                    <button type="submit" class="admin-button">Redaguoti</button>
                    </form>
                    <form method="POST" action="">
                    <div class="mygtukai">
                            <input type="hidden" name="philosophy_delete" value="philosophy_id">
                            <input type="hidden" name="philosophy_id" value="' . $post->ID . '">
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
                    <input type="hidden" name="philosophy_new" value="new philosophy">
                    <div class="form-group">
                        <label class="admin-label">Vizija</label><br>
                        <input type="text" name="vision" value="vision" class="admin-input">
                    </div>
                    <div class="form-group">
                        <label class="admin-label">Misija</label><br>
                        <input type="text" name="mission" value="mission" class="admin-input">
                    </div>
                    <div class="mygtukai">
                        <button type="submit" class="admin-button">Pridėti</button>
                </form>
                    </div>
            </div>
        <br>';
}

