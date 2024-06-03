<?php

namespace app\middlewares;

use app\core\Application;

class DashMiddleware extends BaseMiddleware
{
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest() || !Application::isAdmin() && in_array(Application::$app->controller->action, $this->actions)) {
            Application::$app->session->setFlash('error', 'Permission denied.');
            Application::$app->response->redirect('/');
        }
    }
}