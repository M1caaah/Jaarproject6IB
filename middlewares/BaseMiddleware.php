<?php

namespace app\middlewares;

abstract class BaseMiddleware
{
    public array $actions = [];
    abstract public function execute();
}