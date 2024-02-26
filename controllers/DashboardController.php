<?php

namespace app\controllers;

use app\core\Controller;

class DashboardController extends Controller
{
    public function main()
    {
        return $this->render('dashMain', 'dashboard');
    }

    public function users()
    {
        return $this->render('dashUsers', 'dashboard');
    }

    public function addUsers()
    {
        return $this->render('dashAddUsers', 'dashboard');
    }

    public function orders()
    {
        return $this->render('dashOrders', 'dashboard');
    }

    public function addOrders()
    {
        return $this->render('dashAddOrders', 'dashboard');
    }

    public function products()
    {
        return $this->render('dashProducts', 'dashboard');
    }

    public function addProducts()
    {
        return $this->render('dashAddProducts', 'dashboard');
    }
}