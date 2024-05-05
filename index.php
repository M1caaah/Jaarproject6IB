<?php

use app\controllers\AuthController;
use app\controllers\DashMainController;
use app\controllers\DashOrderController;
use app\controllers\DashProductController;
use app\controllers\DashUserController;
use app\controllers\SiteController;
use app\controllers\UserController;
use app\core\Application;

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'user' => $_ENV['DB_USER'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
        'dbname' => $_ENV['DB_NAME'] ?? 'bytebazaar',
    ],
    'userClass' => \app\models\User::class,
    'cartClass' => \app\models\Cart::class
    ];

$app = new Application(dirname(__DIR__), $config);

// Main site routes
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/home', [SiteController::class, 'home']);

// Product page routes
$app->router->get('/product', [SiteController::class, 'product']);


// Cart routes
$app->router->get('/profile/cart', [SiteController::class, 'cart']);
$app->router->get('/addtocart', [SiteController::class, 'addtocart']);
$app->router->get('/cartchange', [SiteController::class, 'cartchange']);
$app->router->get('/checkout', [SiteController::class, 'checkout']);

// Auth routes
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

// Profile routes
$app->router->get('/profile', [UserController::class, 'profile']);
$app->router->get('/profile/edit', [UserController::class, 'editProfile']);
$app->router->post('/profile/edit', [UserController::class, 'handleProfile']);
$app->router->get('/profile/orders', [SiteController::class, 'orders']);

// Dashboard routes
$app->router->get('/dashboard', [DashMainController::class, 'main']);
$app->router->get('/dashboard/users', [DashUserController::class, 'users']);
$app->router->get('/dashboard/users/edit', [DashUserController::class, 'editUser']);
$app->router->post('/dashboard/users/edit', [DashUserController::class, 'editUser']);
$app->router->get('/dashboard/users/add', [DashUserController::class, 'addUsers']);
$app->router->post('/dashboard/users/add', [DashUserController::class, 'addUsers']);
$app->router->get('/dashboard/users/delete', [DashUserController::class, 'deleteUser']);

$app->router->get('/dashboard/products', [DashProductController::class, 'products']);
$app->router->get('/dashboard/products/add', [DashProductController::class, 'addProduct']);
$app->router->post('/dashboard/products/add', [DashProductController::class, 'addProduct']);
$app->router->get('/dashboard/products/edit', [DashProductController::class, 'editProduct']);
$app->router->post('/dashboard/products/edit', [DashProductController::class, 'editProduct']);
$app->router->get('/dashboard/products/delete', [DashProductController::class, 'deleteProduct']);

$app->router->get('/dashboard/orders', [DashOrderController::class, 'orders']);


$app->run();