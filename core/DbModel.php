<?php

namespace app\core;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;
    abstract public static function primaryKey(): string;
    abstract public function attributes(): array;
    abstract public function datatypes(): string;
    abstract public function labels(): array;

    public function insert()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $datatypes = $this->datatypes();
        $params = array_map(fn($attr) => "?", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")");
        foreach ($attributes as $attribute) {
            $values[] = $this->{$attribute};
        }
        $statement->bind_param($datatypes, ...$values);

        $statement->execute();
        return true;
    }

    public function select(array $columns, string $where): array|null
    {
        $tableName = $this->tableName();
        $columns = implode(",", $columns);
        $sql = "SELECT $columns FROM $tableName WHERE $where AND `active` = 1";
        $statement = self::prepare($sql);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function selectAll(array $columns): array|null
    {
        $tableName = $this->tableName();
        $columns = implode(",", $columns);
        $sql = "SELECT $columns FROM $tableName WHERE `active` = 1";
        $statement = self::prepare($sql);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function delete($id)
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();
        $sql = "UPDATE $tableName SET `active` = 0 WHERE $primaryKey = ?";
        $statement = self::prepare($sql);
        $statement->bind_param('i', $id);
        $statement->execute();
    }

    public function update($id)
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $set = implode(', ', array_map(fn($attr) => "$attr = '".$this->{$attr}."'", $attributes));
        $sql = "UPDATE $tableName SET $set WHERE `".static::primaryKey()."` = ? AND `active` = 1";
        $statement = self::prepare($sql);
        $statement->bind_param('i', $id);
        $statement->execute();
        return true;
    }

    public static function findOne(array $where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $datatypes = str_repeat('s', count($attributes));
        $params = implode(" AND ", array_map(fn($attr) => "$attr = ?", $attributes));
        $sql = "SELECT * FROM $tableName WHERE $params AND `active` = 1";
        $statement = self::prepare($sql);
        $values = [];
        foreach ($where as $item) {
            $values[] = $item;
        }
        $statement->bind_param($datatypes, ...$values);
        $statement->execute();
        return $statement->get_result()->fetch_object(static::class);
    }

    public static function prepare(string $sql): false|\mysqli_stmt
    {
        return Application::$app->db->mysqli->prepare($sql);
    }
}
