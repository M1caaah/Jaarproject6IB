<?php

require_once __DIR__ . '/../vendor/autoload.php';

use \app\controllers\SiteController;
use \app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/home', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);

$app->router->post('/', [SiteController::class, 'handleHome']);
$app->router->post('/home', [SiteController::class, 'handleHome']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);
$app->run();