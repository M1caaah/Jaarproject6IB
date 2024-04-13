<?php

namespace app\controllers;

use app\core\Controller;
use app\models\DashUsers;

class DashMainController extends Controller
{
    public function main(): array|bool|string
    {
        $dashUsers = new DashUsers();
        return $this->render('dashMain', 'dashboard', ['model' => $dashUsers]);
    }

}