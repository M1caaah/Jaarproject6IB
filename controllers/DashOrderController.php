<?php

namespace app\controllers;

use app\core\Controller;
use app\models\DashUsers;

class DashOrderController extends Controller
{
    public function orders(): array|bool|string
    {
        $dashOrders = new DashUsers();
        return $this->render('dashOrders', 'dashboard', ['model' => $dashOrders]);
    }
}