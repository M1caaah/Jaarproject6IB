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
        return $this->render('profile', 'main', ['model' => $profile]);
    }

    public function editProfile(Request $request, Response $response)
    {
        $profile = new Profile();
        if ($request->isPost()) {
            $profile->loadData($request->getBody());
            if ($profile->validate() && $profile->update()) {
                Application::$app->session->setFlash('success', 'Profile updated successfully');
                $response->redirect('/profile');
                return true;
            }
        }
        return $this->render('profile', 'main', ['model' => $profile]);

    }
}