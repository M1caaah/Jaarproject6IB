<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\DashProducts;

class DashProductController extends Controller
{
    public function products(Request $request, Response $response): array|bool|string
    {
        $dashProducts = new DashProducts();
        return $this->render('dashProducts', 'dashboard', ['model' => $dashProducts]);
    }

    public function addProduct(Request $request, Response $response): array|bool|string
    {
        $dashProducts = new DashProducts();
        if ($request->isPost()) {
            $dashProducts->loadData($request->getBody());
            if ($dashProducts->validate() && $dashProducts->save()) {
                $response->redirect('/dashboard/products');
            }
        }
        return $this->render('dashAddProduct', 'dashboard', ['model' => $dashProducts]);
    }

    public function editProduct(Request $request, Response $response): array|bool|string
    {
        $dashProducts = new DashProducts();
        return $this->render('dashEditProduct', 'dashboard', ['model' => $dashProducts]);
    }

    public function deleteProduct(Request $request, Response $response): array|bool|string
    {
        $dashProducts = new DashProducts();
        $dashProducts->loadData($request->getBody());
        $dashProducts->delete($dashProducts->product_id);
        $response->redirect('/dashboard/products');
    }
}