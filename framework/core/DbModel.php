<?php

namespace app\core;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;
    abstract public function attributes(): array;
    abstract public function datatypes(): array;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $datatypes = $this->datatypes();
        $params = array_map(fn($attr) => "?", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")");
        $statement->bind_param(implode('', $datatypes), ...array_values($attributes));

        $statement->execute();
        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->db->mysqli->prepare($sql);
    }
}
