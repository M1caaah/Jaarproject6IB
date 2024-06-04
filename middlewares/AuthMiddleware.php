<?php

namespace app\middlewares;

use app\core\Application;

class AuthMiddleware extends BaseMiddleware
{
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (!Application::isGuest() && (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions))) {
            Application::$app->response->redirect('/');
        }
    }
}