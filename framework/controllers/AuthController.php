<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return $this->render('login', 'auth');
    }

    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost())
        {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->register())
            {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
            }
            return $this->render('register', 'auth', ['model' => $user]);
        }

        return $this->render('register', 'auth', ['model' => $user]);
    }
}