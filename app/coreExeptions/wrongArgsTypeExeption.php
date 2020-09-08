<?php
namespace BIT\app\coreExeptions;

class wrongArgsTypeExeption extends \Exception{
    function __construct($message = ''){
        echo $message;
        // echo \Exception::getTraceAsString();
    }

}
