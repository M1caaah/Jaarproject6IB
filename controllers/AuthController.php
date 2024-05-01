<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Login;
use app\models\User;

class AuthController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $loginForm = new Login();
        if ($request->isPost())
        {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login())
            {
                Application::$app->session->setFlash('success', 'Logged in successfully');
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
                $userLogin = User::findOne(['email' => $user->email]);
                Application::$app->login($userLogin);
                $response->redirect('/');
                return true;
            }
            return $this->render('register', 'auth', ['model' => $user]);
        }

        return $this->render('register', 'auth', ['model' => $user]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        Application::$app->session->setFlash('success', 'Logged out successfully');
        $response->redirect('/');
    }
}