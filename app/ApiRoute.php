<?php

namespace BIT\app;

use BIT\app\App;

class ApiRoute
{
    function apiRoute() {
        /**$get_param = $_GET['route'] - /bebras/api/?route=labas*/
        //$param = get_query_var( 'route', '' );    // wp metodas
        $get_param = $request->query->get('route', '');
        $app = App::start();    //get App Singelton, kad nekurti naujo App objekto
        $routes = $app->routeDir.'apiRoutes.php';
        foreach ($routes as $key => $route) {
            if ($key == $get_param) {
                list($controller, $method) = explode('@', $route);
                $spacenameController = 'BIT\\controllers\\' . $controller;
                return (new $spacenameController)->$method();
            }
        }
        
    }
}