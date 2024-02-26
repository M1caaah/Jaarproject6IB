<?php

namespace app\controllers;

use app\core\Controller;

class DashboardController extends Controller
{
    public function dashMain()
    {
        return $this->render('dashboard', 'dashboard');
    }
}