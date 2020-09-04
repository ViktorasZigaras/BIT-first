<?php

namespace BIT\app;

use BIT\app\App;

class FrontRouter
{
/** Iš frontRoutes.php paima kontrolerį ir metodą ir jį paleidžia*/
    public function frontRoute($atts) {
        $app = App::start();
        $routes = require $app->routeDir.'frontRoutes.php';

        $a = shortcode_atts( [
            'route' => '',	
        ], $atts );

        list($controller, $method) = explode('@', $routes[$a['route']]);
        $controller = 'BIT\\controllers\\' . $controller;
        return $app->run($controller, $method);
        // return (new $controller)->$method();
    }

/**App __construct() uzregistruoti FrontRoute klase add_shortcode*/
//add_shortcode( 'front_shortcode', 'frontRoute' );

/**Shortcode iškvietimas*/
//[front_shortcode route="event"]

}