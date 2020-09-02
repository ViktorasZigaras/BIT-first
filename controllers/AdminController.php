<?php

namespace BIT\controllers;

use BIT\app\App;

class AdminController {
    public function __construct()
    {
        echo "Create HomeController";
    }

    function renderAdminController_index() {
        echo 'Admin <br>';
        $app = App::start();
        // print_r($app);
        echo '<br> ' . $app->routeDir;
    }
    
    function renderFrontController_index() {
        echo 'Front';
    }
    
    function renderApiController_index() {
        echo 'Api';
    }

}