<?php

namespace BIT\app;

use BIT\app\App;

class FrontRoute
{
// Iš frontRoutes.php paima kontrolerį ir metodą ir jį paleidžia
    function frontRoute($atts) {
        // $app = new App;
        $app = App::start();        
        $routes = $app->routeDir.'frontRoutes.php';

        $a = shortcode_atts( [
            'route' => '',	
        ], $atts );

        list($controller, $method) = explode('@', $routes[$a['route']]);
        return (new $controller)->$method();
    }

/**App start() uzregistruoti FrontRoute klase add_shortcode*/
//add_shortcode( 'front_shortcode', 'frontRoute' );

/**Shortcode iškvietimas*/
//[front_shortcode route="event"]

}