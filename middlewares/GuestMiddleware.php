<?php

namespace app\middlewares;

use app\core\Application;

class GuestMiddleware extends BaseMiddleware
{
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest() && in_array(Application::$app->controller->action, $this->actions)) {
            Application::$app->response->redirect('/login');
        }
    }
}