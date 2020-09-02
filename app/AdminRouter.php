<?php

namespace BIT\app;

use BIT\app\App;

class AdminRouter {

    public function __construct(App $app) {
        add_action('admin_menu', function() {
            // add_menu_page('Title', 'Menu', 'manage_options', 'Path', 'render_event_function');
        
            // $app = App::start();
            // 'admin' => 'AdminController@index'
            // echo $app->routeDir;
            // echo $app->routeDir;
            // $routes = require $app->routeDir . 'adminRoute.php';
            // $routes = require '../routes/adminRoute.php';
            $routes = require 'C:\xampp\htdocs\wordpress\wp-content\plugins\BIT-first\routes/adminRoute.php';
            foreach ($routes as $path => $route) {
                list($controller, $function) = explode('@', $route, 2);
                add_menu_page(ucfirst($path) . ' Title', ucfirst($path) . ' Menu' . $app->routeDir, 'manage_options', $path, 'render' . $controller . '_' . $function);
            }
        
            // add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null );
            // add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', int $position = null );
        
            // add_submenu_page('bebras', 'Page title 2', 'Menu title 2', 'manage_options', 'bebras2', 'bebro_funkcija2');
            // add_submenu_page('bebras', 'Edit', null, 'manage_options', 'bebras3', 'bebro_funkcija3');
        });
    }

}