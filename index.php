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
    // $app = App::start();
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

function renderEventController_index()
{
    // echo count(get_posts()) . ' count <br><br>';
    $posts = get_posts([
        'post_type' => 'Event',
        'post_status' => 'publish',
        'numberposts' => -1
        // 'order'    => 'ASC'
    ]);
    foreach ($posts as $post) {
         '<br><br>';
         'ID: ' . $post->ID . '<br>';
         'post_type: ' . $post->post_type . '<br>';
         'post_title: ' . $post->post_title . '<br>';
         'post_name: ' . $post->post_name . '<br>';
         'post_author: ' . $post->post_author . '<br>';
         'post_date: ' . $post->post_date . '<br>';
         'post_modified: ' . $post->post_modified . '<br>';
         'guid: <a href="' . $post->guid . '">' . $post->guid . '</a><br>';
         'post_content: ' . $post->post_content . '<br><br>';
        $metas = get_post_meta($post->ID);
        // print_r($metas);
        //  $metas['text'] . '<br>';
        //  $metas['date'] . '<br>';
        //ADMIN INTERFACE------------------------------------------------------------->
        foreach ($metas as $meta) {
             $meta[0] . '<br>';
        }
        echo '<br>
        <div class="admin-event-div">
        <form class="admin-event-forms" method="POST" action="">
            <input type="hidden" name="event_update" value="update event">
            <input type="hidden" name="event_id" value="' . $post->ID . '">
            <div class="admin-event-form-group">
                <label class="admin-label">Keisti įvykio pavadinimą:</label><br>
                <input class="admin-input" type="text" name="title" value="' . $metas['title'][0] . '">
            </div>
            <div class="admin-event-form-group">
                <label class="admin-label">Redaguoti tekstą:</label><br>
                <input name="text" type="text" class="admin-input" value="' . $metas['text'][0] . '">
            </div>
            <div class="admin-event-form-group">
                <label class="admin-label">Data:</label><br>
                <input class="admin-input" type="datetime-local" value="' . $metas['date'][0] . '" name="date">
            </div>
            <div class="admin-event-buttons">
                <button type="submit" class="admin-event-button">Redaguoti</button>
            </div>
        </form>
        <form method="POST" action="">
            <div class="admin-event-buttons">
                <input type="hidden" name="event_delete" value="event_id">
                <input type="hidden" name="event_id" value="' . $post->ID . '">
                <button type="submit" class="admin-event-button">Trinti</button>
            </div>
        </form>
        <!--<div>
            <select name="cars">
            <option value="' . $metas['title'][0] . '">' . $metas['title'][0] . '</option>
            </select>
        </div>-->
    </div>
   
    
    <br>';
        // WP_Post Object ( [ID] => 7 [post_author] => 1 [post_date] => 2020-08-21 13:46:27 [post_date_gmt] => 2020-08-21 13:46:27 [post_content] => post_content [post_title] => testing [post_excerpt] => [post_status] => publish [comment_status] => closed [ping_status] => closed [post_password] => [post_name] => testing [to_ping] => [pinged] => [post_modified] => 2020-08-21 13:46:27 [post_modified_gmt] => 2020-08-21 13:46:27 [post_content_filtered] => [post_parent] => 0 [guid] => http://localhost/wordpress/event/testing/ [menu_order] => 0 [post_type] => event [post_mime_type] => [comment_count] => 0 [filter] => raw )
    }

    //-----------ADMIN IVYKIO PRIDEJIMAS---------------------------//
    echo '<br>
    <div class="admin-event-div">
        <form class="admin-event-forms" method="POST" action="">
            <input type="hidden" name="event_new" value="new event">
            <div class="admin-event-form-group">
                <label class="admin-label">Įvykio pavadinimas</label><br>
                <input type="text" name="title" value="" placeholder="Įrašykite įvykio pavadinimą..." class="admin-input">
            </div>
            <div class="admin-event-form-group">
                <label class="admin-label">Tekstas</label><br>
                <textarea name="text" placeholder="Jūsų tekstas..." class="admin-input"></textarea>
            </div>
            <div class="admin-event-form-group">
                <label class="admin-label">Data</label><br>
                <input type="datetime-local" name="date" class="admin-input">
            </div>
            <div class="admin-event-buttons">
                <button type="submit" class="admin-event-button">Pridėti</button>
            </div>
        </form>
    <div>
    <br>';
}

App::start();