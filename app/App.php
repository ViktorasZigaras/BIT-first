<?php

namespace BIT\app;

use BIT\app\ApiRoute;

class App
{

    private $routeDir;
    private $viewDir;
    private $resourseDir;
    private $apiUrl;
    private $request;

    // construct priskiria savybes, kurie yra keliai
    public function __construct()
    {
        $this->routeDir = PLUGIN_DIR_PATH . 'routes/';
        $this->viewDir = PLUGIN_DIR_PATH . 'views/';
        $this->resourseDir = PLUGIN_DIR_PATH . 'resources/';
        $this->apiUrl = PLUGIN_DIR_URL . 'api/'; // unused
    }

    //sukuria naują objektą
    static public function start()
    {
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_style('app', PLUGIN_DIR_URL . 'public/style/app.css');
            wp_enqueue_style('app');
            wp_enqueue_script('js', PLUGIN_DIR_URL . 'public/js/app.js');
            wp_enqueue_script('js');
            wp_enqueue_script( 'axios', 'https://unpkg.com/axios/dist/axios.min.js' );
        });
        add_shortcode('front_shortcode', 'frontRoute');
        return new self;
    }

    // magic metodas, kuris leidžia prieiti prie privačios savybės
    public function __get($dir)
    {
        return $this->$dir;
    }

}