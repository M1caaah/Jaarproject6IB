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
}