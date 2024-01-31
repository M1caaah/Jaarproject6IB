<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new \app\core\Application();

$app->router->get('/', function(){
     return 'Hello world';
});

$app->router->get('/contact', function(){
    return 'Contact';
});

$app->run();