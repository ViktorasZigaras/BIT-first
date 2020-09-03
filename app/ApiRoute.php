<?php

namespace BIT\app;

use BIT\app\App;
use BIT\app\TestController; //?????

class ApiRoute
{
    static function apiRoute(/*App $app*/) {
        $get_param = $_GET['route']; // bebras/api/?route=labas
        //$param = get_query_var( 'route', '' );

        // $get_param = $request->query->get('route', '');
        // $app = App::start();        
        $routes = require PLUGIN_DIR_PATH . 'routes/apiRoutes.php';
        // $routes = $app->routeDir.'apiRoutes.php';
        // var_dump($routes);
        // var_dump($get_param);
        foreach ($routes as $key => $route) {
            if ($key == $get_param) {
                list($controller, $method) = explode('@', $route);
                $controller = 'BIT\\controllers\\' . $controller;
                // echo $controller . ' ' . $method;
                return (new $controller)->$method();
            }
        }
        
    }
}