<?php
namespace Symfony\Component\DependencyInjection\Loader\Configurator;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/vendor/autoload.php';

return function(ContainerConfigurator $configurator) {

    echo "blablablablabl";
    $services = $configurator->services();
    //kur nurodyti $request????
    $services->set('request', Request::class)
    // $services->set('opt', Opt::class)
    // In versions earlier to Symfony 5.1 the service() function was called ref()
    ->factory([Request::class, 'createFromGlobals']);
    $services->alias(Request::class, 'request')
    ;
    // $services->alias('request', Symfony\Component\HttpFoundation\Request::class);
        // ->args(['request'])
    ///kaip uzrasyti

};