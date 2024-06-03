<?php

namespace app\controllers;

use app\core\Controller;
use app\models\DashOrders;
use app\models\DashProducts;
use app\models\DashUsers;

/**
 * Routes:
 *  - /dashboard
 */
class DashMainController extends Controller
{
    public function main(): array|bool|string
    {
        $dashUsers = new DashUsers();
        $dashProducts = new DashProducts();
        $dashOrders = new DashOrders();

        return $this->render('dashMain', 'dashboard', ['dashUsers' => $dashUsers, 'dashProducts' => $dashProducts, 'dashOrders' => $dashOrders]);
    }

}