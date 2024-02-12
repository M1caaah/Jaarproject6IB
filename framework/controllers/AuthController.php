<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return $this->render('login', 'auth');
    }

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();
        if ($request->isPost())
        {
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->register())
            {
                return 'Success';
            }
            return $this->render('register', 'auth', ['model' => $registerModel]);
        }

        return $this->render('register', 'auth', ['model' => $registerModel]);
    }
}