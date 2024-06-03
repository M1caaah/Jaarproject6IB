<?php

namespace app\core;

use app\middlewares\BaseMiddleware;

abstract class Controller
{
    public string $action = '';
    public array $middlewares = [];

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function render($view, $layout = 'main', $params = [])
    {
        return Application::$app->router->renderView($view, $layout, $params);
    }
}