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
use BIT\app\RequestId;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
//paskui istrinti

require_once __DIR__.'/vendor/autoload.php';
define('PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

//testas, psakui istrinti
// $app = App::start();
// //$newsPost = $app->containerBuilder->get('newsPost');
// $request = $app->getService(Request::class);
// // var_dump( $newsPost);
// //  $request = $request->query->get('page');
// // var_dump($request);
// echo '<br>';

// $query = new Query;


// $requestId = new RequestId($request);
// var_dump($requestId);
// 
// $getPostType = $query->postType('event')->getPost();
// $getPostTitle = $query->postTitle('Ivykiai')->getPost();
// var_dump($query);
// var_dump($getPostType);
// var_dump($getPostTitle);
//paskui istrinti

// add_action('init', function() {
//     echo '<pre>';
//     print_r(get_taxonomies());
// });

App::start();