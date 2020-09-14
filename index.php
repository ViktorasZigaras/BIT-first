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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
require __DIR__ . '/app/Query.php';
// require __DIR__ . '/app/Post.php';

$query = new Query;

$getPostType = $query->postType('news')->postMeta('news_content','Naujiena')->getPost();
var_dump($getPostType);

require_once __DIR__.'/vendor/autoload.php';
define('PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

App::start();

