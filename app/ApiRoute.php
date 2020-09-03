<?php

namespace BIT\app;

use BIT\app\App;
// use Symfony\Component\HttpFoundation\Request;

class ApiRoute
{
    static function apiRoute() {
        // Request $request
        // $get_param = $_GET['route']; // bebras/api/?route=labas
        //$param = get_query_var( 'route', '' );

        $app = App::start();
        $get_param = $app->getService('request')->query->get('route', '');   
        $routes = require PLUGIN_DIR_PATH . 'routes/apiRoutes.php';
        // $routes = $app->routeDir.'apiRoutes.php';
        // var_dump($routes);
        // var_dump($get_param);
        foreach ($routes as $key => $route) {
            if ($key == $get_param) {
                list($controller, $method) = explode('@', $route);
                $controller = 'BIT\\controllers\\' . $controller;
                // echo $controller . ' ' . $method;
                // return (new $controller)->$method();
                return $app->run($controller, $method);
            }
        }
        
    }
}