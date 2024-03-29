<?php namespace App\Lib;

require_once 'app/lib/interfaces/CrudInterface.php';

use App\Lib\Interfaces\CrudInterface;
use mysqli;
use mysqli_sql_exception;
use stdClass;

/*
Most important part of backend, interacts with MySQL database via SQL statements created from QueryBuilder.php.
These 4 methods encompass the core CRUD concepts in relational databases, satisfying most use cases.
Statements requiring multiple values such as VALUES and WHERE are passed in as arrays, using the `...` operator.
*/
abstract class Model implements CrudInterface {
    private mysqli $mysqli;
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }
    public function create(string $insert, array $column, array $values) : object {
        $data = new StdClass();

        $query = (new QueryBuilder())
            ->insert($insert)
            ->columns(...$column)
            ->values(...$values);

        try {
            $this->mysqli->query($query);
            $id = $this->mysqli->insert_id;

            $data->message = "row created successfully";
            $data->id = $id;
        } catch (mysqli_sql_exception $e) {
            $data->message = $e->getMessage();
        }

        return $data;
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
        catch (mysqli_sql_exception $e) {
            $data[] = $e->getMessage();
        }

        return $data;
    }
    public function update(string $update, array $set, array $where) : object {
        $data = new StdClass();

        $query = (new QueryBuilder())
            ->update($update)
            ->set(...$set)
            ->where(...$where);

        try {
            $this->mysqli->query($query);
            $id = $this->mysqli->insert_id;

            $data->message = "row updated successfully";
            $data->id = $id;
        } catch (mysqli_sql_exception $e) {
            $data->message = $e->getMessage();
        }

        return $data;
    }
    public function delete(string $delete, array $where) : object {
        $data = new StdClass();

        $query = (new QueryBuilder())
            ->delete($delete)
            ->where(...$where);

        try {
            $this->mysqli->query($query);
            $data->message = "row deleted successfully";
        } catch (mysqli_sql_exception $e) {
            $data->message = $e->getMessage();
        }

        return $data;
    }
    public function close() {
        $this->mysqli->close();
    }

}