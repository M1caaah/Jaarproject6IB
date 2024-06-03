<?php

namespace app\controllers;

use app\core\Controller;
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
        $this->registerMiddleware(new DashMiddleware(
            ['orders']
        ));
    }

    public function orders(): array|bool|string
    {
        $dashOrders = new DashOrders();
        return $this->render('dashOrders', 'dashboard', ['model' => $dashOrders]);
    }
}