<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\HomeProducts;
use app\models\Order;
use app\models\ProfileOrders;

class SiteController extends Controller
{
    public function home()
    {
        $homeProducts = new HomeProducts();
        return $this->render('home', 'main', ['model' => $homeProducts]);
    }

    public function cart(Request $request, Response $response)
    {
        $cart = Application::$app->cart;
        return $this->render('cart', 'main', ['model' => $cart]);
    }

    public function addtocart(Request $request, Response $response)
    {
        $cart = Application::$app->cart;
        $cart->addToCart($request->getBody()['product_id']);
        $response->redirect('/profile/cart');
    }

    public function cartchange(Request $request, Response $response)
    {
        $cart = Application::$app->cart;
        foreach ($cart->cartItems as $item) {
            if ($item->cart_item_id == $request->getBody()['cart_item_id']) {
                $item->quantity += $request->getBody()['qc'];
                if ($item->quantity < 1) {
                    $item->delete($item->cart_item_id);
                } else {
                    $item->update($item->cart_item_id, checkActive: false);
                }
            }
        }
        $response->redirect('/profile/cart');
    }

    public function checkout(Request $request, Response $response)
    {
        $cart = Application::$app->cart;
        $order = new Order();
        $order->saveOrder($cart);
        $response->redirect('/');
    }

    public function orders(Request $request, Response $response)
    {
        $orders = new ProfileOrders();
        return $this->render('orders', 'main', ['model' => $orders]);
    }
}