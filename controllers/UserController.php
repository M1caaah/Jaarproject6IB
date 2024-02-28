<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\PasswordReset;
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
        $passwordModel = new PasswordReset();

        $profile->loadData($profile->getUserData());
        return $this->render('profileEdit', 'main', ['model' => $profile, 'passwordModel' => $passwordModel]);
    }

    public function handleProfile(Request $request, Response $response)
    {
        $profile = new Profile();
        $passwordReset = new PasswordReset();

        if ($request->formNamePost() === 'info')
        {
            $profile->loadData($request->getBody());
            if ($profile->validate() && $profile->updateInfo())
            {
                Application::$app->session->setFlash('success', 'Profile updated successfully');
                $response->redirect('/profile');
                return true;
            }
        }

        if ($request->formNamePost() === 'password')
        {
            $profile->loadData($profile->getUserData());
            $passwordReset->loadData($request->getBody());
            if ($passwordReset->validate() && $passwordReset->updatePassword())
            {
                Application::$app->session->setFlash('success', 'Password updated successfully');
                $response->redirect('/profile');
                return true;
            }
        }

        if ($request->formNamePost() === 'deactivate')
        {
            if ($profile->deactivateUser())
            {
                Application::$app->session->setFlash('success', 'Profile deactivated successfully');
                Application::$app->logout();
                $response->redirect('/');
                return true;
            }
        }

        return $this->render('profileEdit', 'main', ['model' => $profile, 'passwordModel' => $passwordReset]);
    }
}