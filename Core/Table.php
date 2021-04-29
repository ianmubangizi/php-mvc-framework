<?php

namespace Mubangizi\Core;

use Mubangizi\Core\Model;

abstract class Table extends Model
{

    protected static function db(): \PDO
    {
        return Application::$app->database->db;
    }

    protected function primary_key()
    {
        return 'id';
    }

    public abstract function table_name(): string;
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

    public function exists(int|string $value, string $column = null, string $table = null)
    {
        $key = $column !== null
            ? $column
            : $this->primary_key();
        $table = $table !== null
            ? $table
            : $this->table_name();
        $statement = $this->prepare("SELECT $key FROM $table WHERE $key = :param;");
        $statement->bindValue(':param', $value);
        $statement->execute();
        return is_array($statement->fetch()) ? true : false;
    }
}
