<?php

namespace app\controllers;

use app\core\Application;

class SiteController
{
    public static function handleContact()
    {
        return Application::$app->router->renderView('contact');
    }
}