<?php

namespace app\core;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;
    abstract public function attributes(): array;
    abstract public function datatypes(): array;
    abstract public function labels(): array;

    public function save(): true
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $datatypes = implode('', $this->datatypes());
        $params = array_map(fn($attr) => "?", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")");
        foreach ($attributes as $attribute) {
            $values[] = $this->{$attribute};
        }
        $statement->bind_param($datatypes, ...$values);

        $statement->execute();
        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->db->mysqli->prepare($sql);
    }
}
