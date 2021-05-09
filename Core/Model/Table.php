<?php

namespace Mubangizi\Core\Model;

use Mubangizi\Core\Application;

abstract class Table extends Model
{

    protected static function db(): \PDO
    {
        return Application::$app->database->db;
    }

    protected static function primary_key(): string
    {
        return 'id';
    }

    public static abstract function table_name(): string;
    protected abstract function table_columns(): array;

    public function columns()
    {
        return array_map(fn ($column) => is_array($column)
            ? $column['name']
            : $column, $this->table_columns());
    }

    public function save()
    {
        $table = $this->table_name();
        $columns = $this->columns();

        $params = implode(',', array_map(fn ($param) => ":$param", $columns));
        $statement = self::prepare("INSERT INTO $table (" . implode(',', $columns) . ") VALUES ($params);");

        foreach ($this->table_columns() as $column) {
            if (is_array($column)) {
                $statement->bindValue(':' . $column['name'], $column['value']);
            } else {
                $statement->bindValue(":$column", $this->{$column});
            }
        }

        return $statement->execute();
    }

    public static function prepare(string $sql)
    {
        return static::db()->prepare($sql);
    }

    public static function exists(int|string $value, string $column = null, string $table = null)
    {
        $key = $column !== null
            ? $column
            : static::primary_key();
        $table = $table !== null
            ? $table
            : static::table_name();
        $statement = static::prepare("SELECT $key FROM $table WHERE $key = :param;");
        $statement->bindValue(':param', $value);
        $statement->execute();
        return is_array($statement->fetch()) ? true : false;
    }


    /**
     * Ideas
     * 
     * ['AND' => ['name' => $name, 'id' => 1], 'OR' => ['email' => $email], 'NOT' => ['id' => $other]]
     *
     * (['name', '=', $name], 'AND', 'NOT', $other)
     */
    public static function where(array $query)
    {
        $keys = array_keys($query);
        $table = static::table_name();
        $where = implode(' AND ', array_map(fn ($key) => "$key = :$key", $keys));
        $statement = static::prepare("SELECT * FROM $table WHERE $where;");
        foreach ($query as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
}
