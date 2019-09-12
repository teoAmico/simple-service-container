<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Service\ServiceContainer;


$container = new ServiceContainer();

try{
    $container->addService('test1', function() use ($container){
        return 'this is a test 1';
    });

    $container->addService('test2', function() use ($container){
        return 'this is a test 2';
    });

    $container->addService('test3', function() use ($container){
        return 'this is a test 3';
    });

    //this will throw an exception because service name duplicated
    $container->addService('test3', function() use ($container){
        return 'this is a test 3';
    });

}catch (\Exception $e){
    var_dump($e->getMessage());
}

var_dump($container->getService('test2'));
$container->remove('test2');
var_dump($container->getServices());