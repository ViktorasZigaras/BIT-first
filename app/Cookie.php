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

    public function ideaCookies($like){
        
        setcookie("Idea_cookie", $like, time()+360*24*60*60, "/", "",  0);//2 månder

        return $like;
    }
}