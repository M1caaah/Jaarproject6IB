<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\DashAddUsers;
use app\models\DashEditUsers;
use app\models\DashUsers;

class DashboardController extends Controller
{
    public function main(): array|bool|string
    {
        $dashUsers = new DashUsers();
        return $this->render('dashMain', 'dashboard', ['model' => $dashUsers]);
    }

    public function users(): array|bool|string
    {
        $dashUsers = new DashUsers();
        return $this->render('dashUsers', 'dashboard', ['model' => $dashUsers]);
    }

    public function editUser(Request $request, Response $response): array|bool|string
    {
        $dashEditUsers = new DashEditUsers();
        $dashEditUsers ->loadData($request->getBody());
        if ($request->isPost())
        {
            $dashEditUsers->loadData($request->getBodyGet());
            if ($dashEditUsers->validate() && $dashEditUsers->updateUser())
            {
                $response->redirect('/dashboard/users');
                return true;
            }
        }
        else
        {
            $dashEditUsers->loadData($dashEditUsers->getUserData());
        }
        return $this->render('dashEditUsers', 'dashboard', ['model' => $dashEditUsers]);
    }

    public function deleteUser(Request $request, Response $response): void
    {
        $dashUsers = new DashUsers();
        $dashUsers->loadData($request->getBody());
        $dashUsers->delete($dashUsers->client_id);
        $response->redirect('/dashboard/users');
    }

    public function addUsers(Request $request, Response $response): array|bool|string
    {
        $dashUsers = new DashAddUsers();
        if ($request->isPost())
        {
            $dashUsers->loadData($request->getBody());
            if ($dashUsers->validate() && $dashUsers->saveUser())
            {
                $response->redirect('/dashboard/users');
                return true;
            }
        }
        return $this->render('dashAddUsers', 'dashboard', ['model' => $dashUsers]);
    }

    public function orders(): array|bool|string
    {
        return $this->render('dashOrders', 'dashboard');
    }

    public function addOrders(): array|bool|string
    {
        return $this->render('dashAddOrders', 'dashboard');
    }

    public function products(): array|bool|string
    {
        return $this->render('dashProducts', 'dashboard');
    }

    public function addProducts(): array|bool|string
    {
        return $this->render('dashAddProducts', 'dashboard');
    }
}