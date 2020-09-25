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

    public static function ideaCookie($like){
        $cookieName = "Idea_cookie-".$like;
        if ( isset($_COOKIE[$cookieName]) ) {
            $cookie = unserialize($_COOKIE[$cookieName]);
        } else {
            $cookie = array();
        }     
        if ( ! in_array($like, $cookie) ) {
            $cookie[] = $like;
        }       
        setcookie($cookieName, serialize( $cookie), time()+30*24*60*60, '/');   
        }              
    }
}
