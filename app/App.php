<?php

namespace BIT\app;

use BIT\app\AdminRouter;
use Symfony\Component\HttpFoundation\Request;
require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
// use Symfony\Component\HttpFoundation\Request;
// require_once __DIR__.'/vendor/autoload.php';
// use Symfony\Component\Finder\Finder;

class App {

// $finder = new Finder();
// $finder->in('../data/');
   
    private $routeDir;
    private $viewDir;
    private $resourseDir;
    private $apiUrl;
    private $request;

    // construct priskiria savybes, kurie yra keliai
    public function __construct(){
        // temp Viktoro:
        $generalDir = plugin_dir_path(__FILE__);
        $this->routeDir = substr($generalDir, 0, strlen($generalDir) - 4,) . 'routes/'; 
        // original Ievos:
        // $this->routeDir = plugin_dir_path(__FILE__).'routes/';
        $this->viewDir = plugin_dir_path(__FILE__).'views/'; 
        $this->resourseDir = plugin_dir_path(__FILE__).'resources/'; 
        $this->apiUrl = plugin_dir_url(__FILE__).'api/'; // unused
        // $this->request = Request::createFromGlobals();
    }
    
    //sukuria naują objektą
    static public function start(){
        add_shortcode( 'front_shortcode', 'frontRoute' );

        // temp Viktoro:
        // function load_admin_styles() {
            // get exact css path
            // wp_register_style( 'app.css', plugin_dir_path( __FILE__ ) . 'css/app.css');
            // wp_enqueue_style( 'app.css');
        // }

        // temp Viktoro:
        $app = new self;
        new AdminRouter($app);

        return $app;
    }

    // magic metodas, kuris leidžia prieiti prie privačios savybės
    public function __get($dir)
    {
        return $this->$dir;
    }

}