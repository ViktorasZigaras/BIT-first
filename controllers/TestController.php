<?php

namespace BIT\controllers;

// use BIT\app\App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController {
    public function __construct()
    {
        //
    }

    function testing(Request $request) {
        // $obj = {value: 'displayValue'};
        // return json_encode($obj);
        // echo json_encode([value'not something']);
        // var_dump($request->query->get('route'));
        // echo 'not something';
        $response = new Response;
        $response->prepare($request);
        $response->setContent(json_encode(['a' => 'aaaaaa']));
        return $response;
    }
}