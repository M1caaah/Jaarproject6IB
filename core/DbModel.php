<?php

namespace app\core;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;
    abstract public static function primaryKey(): string;
    abstract public function attributes(): array;
    abstract public function datatypes(): array;
    abstract public function labels(): array;

    public function save()
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

    public static function findAll()
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName");
        $statement->execute();
        return $statement->get_result()->fetch_all();
    }

    public function findAllActive()
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName WHERE active = 1");
        $statement->execute();
        return $statement->get_result()->fetch_all();
    }

    public function findActive($where)
    {
        $tableName = static::tableName();

        $statement = self::prepare("SELECT * FROM $tableName WHERE active = 1 AND $where");
        $statement->execute();
        return $statement->get_result()->fetch_all();
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = ?", $attributes));
        $datatypes = implode('', array_map(fn($attr) => 's', $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $item) {
            $values[] = $item;
        }
        $statement->bind_param($datatypes, ...$values);
        $statement->execute();
        return $statement->get_result()->fetch_object(static::class);
    }

    public static function prepare($sql)
    {
        return Application::$app->db->mysqli->prepare($sql);
    }
}
