<?php

namespace BIT\app;

use Symfony\Component\HttpFoundation\Request;
// require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

// use Symfony\Component\Finder\Finder;

use BIT\app\ApiRoute;

class App
{

    private $containerBuilder;
    private $loader;
    private $routeDir;
    private $viewDir;
    private $resourseDir;
    private $apiUrl;

    static private $obj;

    public static function start()
    {
        return self::$obj ?? self::$obj = new self;
    }

    //keiciam i private?
    private function __construct(){
        $this->routeDir = PLUGIN_DIR_PATH . 'routes/';
        $this->viewDir = PLUGIN_DIR_PATH . 'views/';
        $this->resourseDir = PLUGIN_DIR_PATH . 'resources/';
        $this->apiUrl = PLUGIN_DIR_URL . 'api/'; // unused
        $this->containerBuilder = new ContainerBuilder();
        $this->loader = new PhpFileLoader($this->containerBuilder, new FileLocator(__DIR__));
        $this->loader->load('service.php');
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_style('app', PLUGIN_DIR_URL . 'public/style/app.css');
            wp_enqueue_style('app');
            wp_enqueue_script('js', PLUGIN_DIR_URL . 'public/js/app.js');
            wp_enqueue_script('js');
            wp_enqueue_script( 'axios', 'https://unpkg.com/axios/dist/axios.min.js' );
        });
        add_shortcode('front_shortcode', 'frontRoute');
        // $this->request = Request::createFromGlobals();
    }

    //Julius duos konstantas - plugin_dir ir plugin_url
    //sukuria naują objektą
    public function getService($service){
        return  $this->containerBuilder->get($service);
    }
//paleisti
// arba stat kaip singleton arba getApp() metoda, kad visi galetu gauti objekta. Arba is starto padaryti, kad jeigu sukurtas grazina, o jeigu ne, tai sukuria nauja. Starta i bendrini pavadinima.

    public function run($controller, $method)
    {
        $this->controller = $controller;
        $this->method = $method;
        // $this->controller = $this->routes->getController($route); //BebroController
        // $this->method = $this->routes->getMethod($route); //bebras
        $this->reflectionParams = (new \ReflectionMethod($this->controller, $this->method))->getParameters();

        foreach ($this->reflectionParams as $val) {
            if ($val->getType()) {
                $params[] = $this->getService($val->getType()->getName()); // kvieciu is konteinerio
            }
        } 
        return (new $this->controller)->{$this->method}(...$params);
    }

    // magic metodas, kuris leidžia prieiti prie privačios savybės
    public function __get($dir)
    {
        return $this->$dir;
    }

}