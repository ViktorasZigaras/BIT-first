<?php
namespace BIT\app;

class Cookie {
    static private $uuid;
    
    public static function getUuid(){
        self::$uuid = rand(1000, 2000);
        if (!isset($_COOKIE['Bit'])) {
            setcookie("Bit", self::$uuid);
        }
        return self::$uuid;
    }

    public function __get($dir)
    {
        return $this->$dir;
    }
}