<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\HomeProducts;

class SiteController extends Controller
{
    public function home()
    {
        $homeProducts = new HomeProducts();
        return $this->render('home', 'main', ['model' => $homeProducts]);
    }

    public function addtocart(Request $request, Response $response)
    {
        $cart = Application::$app->cart;
        return $this->render('addtocart');
    }

    public function handleHome()
    {

    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return 'Handling submitted data';
    }
}