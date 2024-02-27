<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Profile;

class UserController extends Controller
{
    public function profile(Request $request, Response $response)
    {
        $profile = new Profile();
        $profile->loadData($profile->getUserData());
        return $this->render('editProfile', 'main', ['model' => Application::$app->user]);
    }

    public function editProfile(Request $request, Response $response)
    {
        $profile = new Profile();
        if ($request->isPost()) {

            $profile->loadData($request->getBody());
        }
        return $this->render('profile', 'main', ['model' => $profile]);

    }
}