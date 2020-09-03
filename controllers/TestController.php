<?php

namespace BIT\controllers;

// use BIT\app\App;
use Symfony\Component\HttpFoundation\Request;

class TestController {
    public function __construct()
    {
        //
    }

    function testing(Request $request) {
        // $obj = {value: 'displayValue'};
        // return json_encode($obj);
        // echo json_encode([value'not something']);
        var_dump($request->query->get('route'));
        echo 'not something';
    }
}