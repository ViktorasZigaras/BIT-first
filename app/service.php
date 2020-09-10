<?php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;
use Symfony\Component\HttpFoundation\Request;
use BIT\models\NewsPost;
use BIT\app\RequestId;

// require_once __DIR__.'/vendor/autoload.php';

return function(ContainerConfigurator $configurator) {

    $services = $configurator->services();
    $services->set('request', Request::class)
    // $services->set('opt', Opt::class)
    // In versions earlier to Symfony 5.1 the service() function was called ref()
    ->factory([Request::class, 'createFromGlobals']);
    $services->alias(Request::class, 'request');
    
    $services->set('requestId', RequestId::class)
    // ->factory([NewsPost::class, 'get'])
    ->args([ref(Request::class)]);
    $services->alias(RequestId::class, 'requestId');

    $services->set('newsPost', NewsPost::class)
    // ->factory([NewsPost::class, 'get'])
    ->args([ref(RequestId::class)]);
    $services->alias(NewsPost::class, 'newsPost');

};