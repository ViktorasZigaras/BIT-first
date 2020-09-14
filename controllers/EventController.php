<?php

namespace BIT\controllers;

use BIT\app\App;
use BIT\app\View;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventController {
    public function __construct()
    {
        //
    }
    
     function events(Request $request) {
        // ob_start();
        // $homepage = file_get_contents('./../views/calendar.php');
        // echo ($homepage);
        // $output = ob_get_contents();
        // ob_end_clean();

        $response = new Response;
        $output = View::render('calendar',['a'=>86]);
        $response->prepare($request);
        $response->setContent(json_encode(['html'=>$output]));
        // var_dump($request->query->get('route'));
        return $response;


    }
    public function index(Request $request)
    {   
        $nevents = EventPost::all();
        return view('calendar.index');
        
    }
    
}