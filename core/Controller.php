<?php

namespace app\core;

abstract class Controller
{
    public function render($view, $layout = 'main', $params = [])
    {
        return Application::$app->router->renderView($view, $layout, $params);
    }
}