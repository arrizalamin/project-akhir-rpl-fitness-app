<?php

namespace App;

use InvalidArgumentException;
use mysqli;

abstract class Database
{
    public static $connection;
    public $table = '';
    private $wheres = [];
    public $attributes;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public static function setConnection(mysqli $connection)
    {
        static::$connection = $connection;
    }

    public function findBy($column, $id)
    {
        return $this->where($column, '=', $id)->first();
    }

    public function where($field, $operator, $value) : Database
    {
        $this->wheres[] = [$field, $operator, $this->sanitize($value)];
        return $this;
    }

    public function get() : array
    {
        return array_map(function($attr) {
            return new static($attr);
        }, $this->getAttibutes());
    }

    public function first()
    {
        $attrs = $this->getAttibutes();
        if (count($attrs) < 1) {
            throw new InvalidArgumentException('Query returned no result');
        }
        return new static($attrs[0]);
    }

    private function fetchQuery() : string
    {
        $query = 'SELECT * FROM ' . $this->table;
        if (count($this->wheres)) {
            $wheres = array_map(function($where) {
                return implode(' ', $where);
            }, $this->wheres);
            $query .= sprintf(" WHERE %s", implode(' AND ', $wheres));
        }
        return $query;
    }

    private function getAttibutes() : array
    {
        $query = $this->fetchQuery();
        $result = mysqli_query(static::$connection, $query);
        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC) ?: [];
        }
        return [];
    }

    public function insert(array $data) : bool
    {
        $values = array_map(function($value) {
            return $this->sanitize($value);
        }, array_values($data));
        $query = sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->table, implode(', ', array_keys($data)), implode(', ', $values));

        return mysqli_query(static::$connection, $query);
    }

    public function update(array $data, string $primary = 'id') : bool
    {
        $data = array_map(function($key, $value) {
            return $key . '=' . $this->sanitize($value);
        }, array_keys($data), $data);
        $query = sprintf("UPDATE %s SET %s WHERE %s='%s'", $this->table, implode(', ', $data), $primary, $this->$primary);
        return mysqli_query(static::$connection, $query);
    }

    public function delete(string $primary = 'id') : bool
    {
        $query = "DELETE FROM {$this->table} WHERE {$primary}='{$this->$primary}'";
        return mysqli_query(static::$connection, $query);
    }

    protected function hasMany($foreignModel, $foreignId, $modelId = 'id') : array
    {
        return (new $foreignModel)->where($foreignId, '=', $this->{$modelId})->get();
    }

    protected function belongsTo($foreignModel, $foreignId, $modelId = 'id')
    {
        return (new $foreignModel)->findBy($modelId, $this->{$foreignId});
    }

    private function sanitize($value)
    {
        if (is_string($value)) {
            $value = mysqli_escape_string(static::$connection, $value);
            return "'$value'";
        }
        return $value;
    }

    public function __get($name)
    {
        return $this->attributes[$name];
    }
}