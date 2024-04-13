<?php

namespace app\core;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;
    abstract public static function primaryKey(): string;
    abstract public function attributes(): array;
    abstract public function datatypes(): string;
    abstract public function labels(): array;

    public function insert($tableName = "", $attributes = [], $values = [], $datatypes = "")
    {
        $tableName = $tableName ?: $this->tableName();
        $attributes = $attributes ?: $this->attributes();
        $attributes = $this->processAliases($attributes, false);
        $datatypes = $datatypes ?: $this->datatypes();
        $params = array_map(fn($attr) => "?", $attributes);

        $sql = "INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")";
        $statement = self::prepare($sql);
        foreach ($attributes as $attribute) {
            $values[] = $this->{$attribute};
        }
        $statement->bind_param($datatypes, ...$values);

        $statement->execute();
        return true;
    }

    public function select(array $columns, string $where = "", string $oderby = "", int $limit = null, string $tableName = "", bool $checkActive = true): array|null
    {
        $tableName = $tableName ?: $this->tableName();
        $columns = $this->processAliases($columns, true);
        $columns = implode(",", $columns);

        $sql = "SELECT $columns FROM $tableName";

        if ($where) $sql .= " WHERE $where";
        else if ($checkActive) $sql .= " WHERE `active` = 1";
        if ($oderby) $sql .= " ORDER BY $oderby";
        if ($limit) $sql .= " LIMIT $limit";

        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function selectAll(array $columns, string $tableName = ""): array|null
    {
        $tableName = $tableName ?: $this->tableName();
        $columns = implode(",", $columns);
        $sql = "SELECT $columns FROM $tableName WHERE `active` = 1";
        $statement = self::prepare($sql);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function delete(int $id, string $tableName = "", string $primaryKey = ""): bool
    {
        $tableName = $tableName ?: $this->tableName();
        $primaryKey = $primaryKey ?: $this->primaryKey();
        $sql = "UPDATE $tableName SET `active` = 0 WHERE $primaryKey = ?";
        $statement = self::prepare($sql);
        $statement->bind_param('i', $id);
        $statement->execute();
        return true;
    }

    public function update(int $id, array $attributes = [], string $tableName = "", string $primaryKey = "")
    {
        $tableName = $tableName ?: $this->tableName();
        $primaryKey = $primaryKey ?: $this->primaryKey();
        $attributes = $attributes ?: $this->attributes();
        $attributes = $this->processAliases($attributes, false);
        $set = implode(', ', array_map(fn($attr) => "$attr = '".$this->{$attr}."'", $attributes));
        $sql = "UPDATE $tableName SET $set WHERE $primaryKey = ? AND `active` = 1";
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

    public function getRoles(): array|null
    {
        return $this->select(['tr.role_id', 'roleName'], tableName: 'tblroles tr', checkActive: false);
    }

    public static function prepare(string $sql): false|\mysqli_stmt
    {
//        echo '<pre>';
//        var_dump($sql);
//        echo '</pre>';
        return Application::$app->db->mysqli->prepare($sql);
    }

    protected function processAliases(array $attributes, bool $keepAlias): array
    {
        $array = [];
        foreach ($attributes as $attribute)
        {
            if (is_array($attribute) && $keepAlias) $array[] = implode('.', $attribute);
            else if (is_array($attribute) && !$keepAlias) $array[] = $attribute[1];
            else $array[] = $attribute;
        }
        return $array;
    }
}
