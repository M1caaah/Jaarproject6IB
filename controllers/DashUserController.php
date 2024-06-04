<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\middlewares\DashMiddleware;
use app\models\DashAddUsers;
use app\models\DashEditUsers;
use app\models\DashUsers;

/**
 * Routes:
 *  - /dashboard/users
 *  - /dashboard/users/edit
 */
class DashUserController extends Controller
{
    function __construct()
    {
        $this->registerMiddleware(new DashMiddleware(
            ['users', 'editUser', 'deleteUser', 'addUsers']
        ));
    }

    public function users(Request $request, Response $response): array|bool|string
    {
        $dashUsers = new DashUsers();
        $dashUsers->loadData($request->getBody());
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
        $dashUsers->deactivate($dashUsers->client_id);
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

}