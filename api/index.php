<?php
require __DIR__ . '/../../../../wp-load.php';

// require(C:\\xampp\\htdocs\\wordpress\\wp-content\\plugins\\BIT-first\\api/../../../../../wp-load.php

require_once '../vendor/autoload.php';

// C:\\xampp\\htdocs\\wordpress\\wp-content\\plugins\\BIT-first\\api../vendor/autoload.php

if (!defined('PLUGIN_DIR_URL')){
    define('PLUGIN_DIR_URL', plugin_dir_url(__FILE__));}

if (!defined('PLUGIN_DIR_URL')){
    define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}

// require_once PLUGIN_DIR_PATH . 'vendor/autoload.php';

// use BIT\app\App;
use BIT\app\ApiRoute;

// $app = App::start();

$response = ApiRoute::apiRoute(/*$app*/);
    // throw error???
if (!$response) throw Error;
else $response->send();

