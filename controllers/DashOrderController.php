<?php

namespace app\controllers;

use app\core\Controller;
use app\models\DashOrders;

/**
 * Routes:
 *  - /dashboard/orders
 */
class DashOrderController extends Controller
{
    public function orders(): array|bool|string
    {
        $dashOrders = new DashOrders();
        return $this->render('dashOrders', 'dashboard', ['model' => $dashOrders]);
    }
}