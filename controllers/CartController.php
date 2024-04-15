<?php

namespace app\controllers;

use app\core\Controller;

class CartController extends Controller
{
    public function cart()
    {
        return $this->render('cart', 'main');
    }

    public function checkout()
    {
        return $this->render('checkout', 'main');
    }

    public function handleCheckout()
    {
        return 'Handling checkout';
    }

    public function handleCart()
    {
        return 'Handling cart';
    }
}