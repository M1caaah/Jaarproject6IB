<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($action, $method): void
    {
        echo "<form action='$action' method='$method' enctype='multipart/form-data'>";
    }

    public static function end(): void
    {
        echo "</form>";
    }

    public function field(Model $model, $attribute): Field
    {
        return new Field($model, $attribute);
    }
}