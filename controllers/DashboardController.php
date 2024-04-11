<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\DashUsers;

class DashboardController extends Controller
{
    public function main()
    {
        $dashUsers = new DashUsers();
        return $this->render('dashMain', 'dashboard', ['model' => $dashUsers]);
    }

    public function users()
    {
        $dashUsers = new DashUsers();
        return $this->render('dashUsers', 'dashboard', ['model' => $dashUsers]);
    }

    public function editUser(Request $request, Response $response)
    {
        $dashUsers = new DashUsers();
        $dashUsers->loadData($request->getBody());
        $dashUsers->loadData($dashUsers->getUserData());
        return $this->render('dashEditUsers', 'dashboard', ['model' => $dashUsers]);
    }

    public function deleteUser(Request $request, Response $response)
    {
        $dashUsers = new DashUsers();
        $dashUsers->loadData($request->getBody());
        $dashUsers->delete($dashUsers->client_id);
        $response->redirect('/dashboard/users');
    }

    public function addUsers()
    {
        $dashUsers = new DashUsers();
        return $this->render('dashAddUsers', 'dashboard', ['model' => $dashUsers]);
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