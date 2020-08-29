<?php
use Symfony\Component\HttpFoundation\Request;
require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\Finder\Finder;

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
        $this->routeDir = plugin_dir_path(__FILE__).'routes/'; 
        $this->viewDir = plugin_dir_path(__FILE__).'views/'; 
        $this->resourseDir = plugin_dir_path(__FILE__).'resources/'; 
        $this->apiUrl = plugin_dir_url(__FILE__).'api/'; 
        $this->request = Request::createFromGlobals();
    }
    
    //sukuria naują objektą
    static public function start(){
        return new self;
    }

    // magic metodas, kuris leidžia prieiti prie privačios savybės
    public function __get($dir)
    {
        return $this->$dir;
    }

}