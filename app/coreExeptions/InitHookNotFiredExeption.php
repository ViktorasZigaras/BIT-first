<?php
namespace BIT\app\coreExeptions;

class InitHookNotFiredExeption extends \Exception 
{
    function __construct($message = '') 
    {
        echo $message;
        // echo \Exception::getTraceAsString();
    }
}