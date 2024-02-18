<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost())
        {
            $loginForm->loadData($request->getBody());

            if ($loginForm->validate() && $loginForm->login())
            {
                $response->redirect('/');
                return true;
            }
        }
        return $this->render('login', 'auth', ['model' => $loginForm]);
    }

    public function register(Request $request, Response $response)
    {
        $user = new User();
        if ($request->isPost())
        {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->register())
            {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                $response->redirect('/');
            }
            return $this->render('register', 'auth', ['model' => $user]);
        }

        return $this->render('register', 'auth', ['model' => $user]);
    }
}