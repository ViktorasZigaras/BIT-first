<?php

namespace BIT\app;

use BIT\app\App;

class FrontRoute
{
// Iš frontRoutes.php paima kontrolerį ir metodą ir jį paleidžia
    static function frontRoute($atts) {
        // $app = new App;
        $app = App::start();        
        $routes = require $app->routeDir.'frontRoutes.php';
/** Iš frontRoutes.php paima kontrolerį ir metodą ir jį paleidžia*/
    function frontRoute($atts) {
        $app = App::start();     //get App Singelton, kad nekurti naujo App objekto   
        $routes = $app->routeDir.'frontRoutes.php';

        $a = shortcode_atts( [
            'route' => '',	
        ], $atts );
        var_dump ($routes);
        // var_dump ($routes[$a]);
        list($controller, $method) = explode('@', $routes[$a['route']]);
        $controller = 'BIT\\controllers\\' . $controller;
        return (new $controller)->$method();
        $spacenameController = 'BIT\\controllers\\' . $controller;
        return (new $spacenameController)->$method();
    }

/**App __construct() uzregistruoti FrontRoute klase add_shortcode*/
//add_shortcode( 'front_shortcode', 'frontRoute' );

/**Shortcode iškvietimas*/
//[front_shortcode route="event"]

}