<?php
namespace BIT\app;
use BIT\app\Cookie;
use BIT\app\App;
use BIT\app\Session;

// use session

class Transient{
static private $obj;
private $name;
private $value; 
private $newValue;
///turi pereiti per konstruktoriu, tada kitais metodais kreipsimes i objekta.
//delete metodas, kuris automatiskai issikviecia. Pasidaro kopija reiksmiu(objekto savybe) ir tada istrin, kad jo nebebutu transiente, o butu sesijos metu kopijoje, kuria gauna sesijos klase.  
//public static function getTransient($name(cookie uuid), $value)

//tik transiento klase bendrauja su duomennu baze.

    public static function start()
    {
        return self::$obj ?? self::$obj = new self;
    }

    public function __construct(){
        $this->name = Cookie::getUuid();
        $this->value = get_transient($this->name);
        // _dc('1111111111');
        // _dc($this->value);
        // _dc('1111111111');
   
        // _dc('dddddd');
        $this->newValue = $this->value;
        foreach($this->newValue as $index => $string) {
            if (strpos($string, 'autodelete') !== FALSE)
                unset($this->newValue[$index]);  
                $name = substr($string, 11); 
        }
        
        foreach ($this->newValue as $index=>$string){
            if ($index == $name){
                unset($this->newValue[$index]);
            }
        }
        // _dc('000000000');
        // _dc($this->newValue);
        // _dc('000000000');
        // _dc($this->value);
        // set_transient($this->name, $value);
    }

    public function setTransient(){
        $this->newValue = Session::$array;
        // $this->newValue = $session->array;
        // _dc('bbbbbbbb');
        // _dc($this->newValue);
        // _dc('bbbbbbbb');
    }

    public function getTransient(){
        
    }

    public function __destruct(){
        set_transient($this->name,$this->newValue);
    }

    public function deleteTransient($name){
        delete_transient($name);
    }

// getTransient()

// gaunam

// setTransient()

// tik cia settinam transientus

    // public function getTransient(){
    //     // $this->name = $name;
    //     // $this->value = get_transient($this->name);
    //     // _dc($this->value);
    //     // $value = $this->value;
    //     //turi atsirasti transiente;
    //     //  _dc($value);
    //     // _dc($this->value);
    //     // _dc($value);
    //     return $this->value;
    // }
        
    public function __get($dir)
    {
        return $this->$dir;
    }

}


//transiento klase turi gauti transient ir sukurti jam reiksmes papildomas
//isoriniai metodai set, get - kuris gali is transiento tam tikra reiksme - pagal uuid ir key. 
//delete tik tam tikra reiksme is transiento.istrinti turi ir key ir value. 
//ir dar reiki visa transienta ir visa cooki istrinti.(unset)
//flash metodo dar reikia, kuris panasus i set - trumpalaike sesija. panasus laravelyje yra . Kaip set, tik turi viena perkrovima turi galioti. flash reikia zymeti sesijoje tarnybiniais zneklais, ir kai pasibaigs reiks istrinti. 