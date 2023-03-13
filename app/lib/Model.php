<?php namespace App\Lib;

use App\Lib\Interfaces\CrudInterface;
use mysqli;

abstract class Model implements CrudInterface {
    private mysqli $mysqli;
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }
    public function read(array $select, string $from, array $where) : array
    {
        $query = (new QueryBuilder())
            ->select(...$select)
            ->from($from)
            ->where(...$where);

        $data = [];
        try {
            $result = $this->mysqli->query($query);
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }
        }
        catch (\mysqli_sql_exception $e) {
            $data[] = $e->getMessage();
        }

        $this->mysqli->close();
        return $data;
    }
    public function create(string $insert, array $column, array $values) : array {
        $data = [];

        $query = (new QueryBuilder())
            ->insert($insert)
            ->columns(...$column)
            ->values(...$values);

        try {
            $this->mysqli->query($query);
            $id = $this->mysqli->insert_id;
            $data[] = $id;
        } catch (\mysqli_sql_exception $e) {
            $data[] = $e->getMessage();
        }

        return $data;
    }
    public function update(string $update, array $set, array $where) : array {
        $data = [];

        $query = (new QueryBuilder())
            ->update($update)
            ->set(...$set)
            ->where(...$where);

        try {
            $this->mysqli->query($query);
            $id = $this->mysqli->insert_id;
            $data[] = $id;
        } catch (\mysqli_sql_exception $e) {
            $data[] = $e->getMessage();
        }

        return $data;
    }
    public function delete(string $delete, array $where) : array {
        $data = array();

        $query = (new QueryBuilder())
            ->delete($delete)
            ->where(...$where);

        try {
            $this->mysqli->query($query);
            $data[] = "restaurant deleted!";
        }
        catch (\mysqli_sql_exception $e) {
            $data[] = $e->getMessage();
        }

        return $data;
    }
}