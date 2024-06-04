<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\middlewares\DashMiddleware;
use app\models\DashEditProduct;
use app\models\DashProducts;

/**
 * Routes:
 *  - /dashboard/products
 *  - /dashboard/products/add
 *  - /dashboard/products/edit
 *  - /dashboard/products/delete
 */
class DashProductController extends Controller
{
    function __construct()
    {
        $this->registerMiddleware(new DashMiddleware());
    }

    public function products(Request $request, Response $response): array|bool|string
    {
        $dashProducts = new DashProducts();
        $dashProducts->loadData($request->getBody());
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
        $dashEditProduct = new DashEditProduct();
        $dashEditProduct->loadData($request->getBodyGet());
        $dashEditProduct->loadData($dashEditProduct->findOne(['product_id' => $dashEditProduct->product_id]));
        if ($request->isPost()) {
            $dashEditProduct->loadData($request->getBody());
            if ($dashEditProduct->validate() && $dashEditProduct->save()) {
                $response->redirect('/dashboard/products');
            }
        }
        return $this->render('dashEditProduct', 'dashboard', ['model' => $dashEditProduct]);
    }

    public function deleteProduct(Request $request, Response $response): array|bool|string
    {
        $dashProducts = new DashProducts();
        $dashProducts->loadData($request->getBody());
        $dashProducts->deactivate($dashProducts->product_id);
        $response->redirect('/dashboard/products');
        return true;
    }
}