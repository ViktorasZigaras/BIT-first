<?php

namespace BIT\app;

use BIT\app\App;

class ApiRoute
{
    function apiRoute() {
        //$param - $_GET['route'] - /bebras/api/?route=labas
        //$param = get_query_var( 'route', '' );
        $get_param = $request->query->get('route', '');
        $app = App::start();        
        $routes = $app->routeDir.'apiRoutes.php';
        foreach ($routes as $key => $route) {
            if ($key == $get_param) {
                list($controller, $method) = explode('@', $route);
                return (new $controller)->$method();
            }
        }
        
    }
}