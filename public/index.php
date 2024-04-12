<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\DashboardController;
use app\controllers\SiteController;
use app\controllers\UserController;
use app\core\Application;

$config = [
    'db' => [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'dbname' => 'bytebazaar'
    ],
    'userClass' => \app\models\User::class
    ];

$app = new Application(dirname(__DIR__), $config);

// Main site routes
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/home', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/', [SiteController::class, 'handleHome']);
$app->router->post('/home', [SiteController::class, 'handleHome']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

// Auth routes
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

// User routes
$app->router->get('/profile', [UserController::class, 'profile']);
$app->router->get('/profile/edit', [UserController::class, 'editProfile']);
$app->router->post('/profile/edit', [UserController::class, 'handleProfile']);

// Dashboard routes
$app->router->get('/dashboard', [DashboardController::class, 'main']);
$app->router->get('/dashboard/users', [DashboardController::class, 'users']);
$app->router->get('/dashboard/users/edit', [DashboardController::class, 'editUser']);
$app->router->post('/dashboard/users/edit', [DashboardController::class, 'editUser']);
$app->router->get('/dashboard/users/delete', [DashboardController::class, 'deleteUser']);
$app->router->get('/dashboard/users/add', [DashboardController::class, 'addUsers']);
$app->router->post('/dashboard/users/add', [DashboardController::class, 'addUsers']);
$app->router->get('/dashboard/orders', [DashboardController::class, 'orders']);
$app->router->get('/dashboard/orders/add', [DashboardController::class, 'addOrders']);
$app->router->get('/dashboard/products', [DashboardController::class, 'products']);
$app->router->get('/dashboard/products/add', [DashboardController::class, 'addProducts']);

$app->run();