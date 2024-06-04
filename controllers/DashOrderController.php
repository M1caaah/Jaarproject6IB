<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\middlewares\DashMiddleware;
use app\models\DashOrders;

/**
 * Routes:
 *  - /dashboard/orders
 */
class DashOrderController extends Controller
{
    function __construct()
    {
        $this->registerMiddleware(new DashMiddleware());
    }

    public function orders(Request $request, Response $response): array|bool|string
    {
        $dashOrders = new DashOrders();
        $dashOrders->loadData($request->getBody());
        return $this->render('dashOrders', 'dashboard', ['model' => $dashOrders]);
    }

    public function deleteOrder(Request $request, Response $response): bool
    {
        $dashOrders = new DashOrders();
        $dashOrders->loadData($request->getBody());
        $dashOrders->deactivate($dashOrders->order_id, 'tblorders', 'order_id');
        $response->redirect('/dashboard/orders');
        return true;
    }

    public function activateOrder(Request $request, Response $response): bool
    {
        $dashOrders = new DashOrders();
        $dashOrders->loadData($request->getBody());
        $dashOrders->activate($dashOrders->order_id, 'tblorders', 'order_id');
        $response->redirect('/dashboard/orders');
        return true;
    }
}