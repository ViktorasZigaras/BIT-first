<?php

/**
 * Plugin Name: BIT First
 * Plugin URI: https://www.yourwebsiteurl.com/
 * Description: First.
 * Version: 1.0
 * Author: Your Name Here
 * Author URI: http://yourwebsiteurl.com/
 **/
use BIT\app\App;
use BIT\app\Query;
use BIT\app\Post;
use BIT\app\RequestId;
use BIT\app\Cookie;
use BIT\app\Transient;
use BIT\app\Session;
use BIT\controllers\NewsController;
use BIT\models\IdeaPost;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use BIT\app\coreExeptions\wrongArgsTypeExeption;

require_once __DIR__.'/vendor/autoload.php';

define('PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

// $news = new NewsController;
// $index = $news->index($request);

//1.cookie, turi uuida
//2. transientas, kuria reiksmiu masyva;
//3. Seisija, paduoda duomenis, kurie turi isirasyti i transiento reiksmes. 

//sesiju servisas, sesiju klase
//sukuria sesiju objekta, kurios savybe yra bebtas('bebras', 'grazus)
//transientas ima ccokio id i $session->set('b', '82') - sie duomenys turi atsirasti transientu masyve. sesija turi nuspresti, koki transienta naudoti ir i to transiento masyvo turi irasyti reiksmes.;
//$sesion - >('bebras')=>grazus transiente turi atsidurti 

// $session = new Session();
// // _dc($session);
// $val = ["a" => "this should be set to property", "b" => "and this also"];
// // _dc($val);
// // $sessionSet = $session->set($val);
// // _dc($sessionSet);
// // App::start();
// $session = Session::start();

// // $session->deleteTransient('1760');
// // _dc(delete_transient('1828'));
// // _dc($session);
// // $session->set(5,8); 
// // $session->set(4,9);  
// // // $session->set('la','bu'); 
// // $session->set('od',2);
// // $session->set('ob',2);
// $session->set('obd',2);
// // // $session->flash('error', 'Labai labai labai labai lbailabai blogai');
// // $session->flash('flashas',2);
// // //  $session->flash('tralialia','du');
// // // $session->set('vvvvvvvv',2);
// // // $session->set('rrrrrrr',2);
// // $session->set('papapap',2);
// $session->set('bram',2);
// // // $session->set('blalbal',2);
// // // $session->set('ob',3);
// // $session->set('ttttttt',6);

// $transient = Transient::start();
// $transientValue = $transient->setTransient();


// $name = $session->name;
// // $transientElement = $session->getTransientElement($name, 'flashas');
// // _dc($transientElement);

// // _dc($name);
// // _dc(get_transient($name));

// //  _dc($transientNew);

// // $uuid = Cookie::getUuid();
// //$uuid = $cookie->getUuid();
// // $cookie = new Cookie;
// // _dc($cookie);
// // _dc($_COOKIE); 
// // Cookie::deleteCookie('Bit');
// // _dc($_COOKIE); 

// if(count($_COOKIE) > 0) {
//     echo "Cookies are enabled.";
//   } else {
//     echo "Cookies are disabled.";
  // }
//  _dc($uuid);
// 

// $transient = new Transient;
// $transient = $transient->getTransient();
// _dc($transient);


//






// App::start();

