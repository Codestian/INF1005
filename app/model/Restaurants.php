<?php namespace App\Model;

use App\Lib\Interfaces\CrudInterface;
use mysqli;
use App\Lib\QueryBuilder;

class Restaurants implements CrudInterface
{
    private mysqli $mysqli;
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }
    public function getAll() : array
    {
        $query = (new QueryBuilder())
            ->select('id', 'name', 'description', 'address')
            ->from('restaurants');

        $data = array();
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
    public function getOne(int $index) : array {
        $query = (new QueryBuilder())
            ->select('id', 'name', 'description')
            ->from('restaurants')
            ->where('id=' . $index);

        $data = array();
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
    public function create(array $requestData) : array {
        $data = array();

        $query = (new QueryBuilder())
            ->insert('restaurants')
            ->columns('name', 'description', 'address')
            ->values($requestData['name'], $requestData['description'], $requestData['address']);

        try {
            $this->mysqli->query($query);
            $id = $this->mysqli->insert_id;
            $data[] = $id;
        } catch (\mysqli_sql_exception $e) {
            $data[] = $e->getMessage();
        }

        return $data;
    }
    public function update(int $index, array $requestData) : array {
        $data = array();

        $query = (new QueryBuilder())
            ->update('restaurants')
            ->set('name = ' . $requestData['name'], 'description = ' . $requestData['description'], 'address = ' . $requestData['address'])
            ->where('id = ' . $index);

        try {
            $this->mysqli->query($query);
            $id = $this->mysqli->insert_id;
            $data[] = $id;
        } catch (\mysqli_sql_exception $e) {
            $data[] = $e->getMessage();
        }

        return $data;
    }
    public function delete(int $index) : array {
        $data = array();

        $query = (new QueryBuilder())
            ->delete('restaurants')
            ->where('id = ' . $index);

        try {
            $this->mysqli->query($query);
            $data[] = $index . " deleted!";
        }
        catch (\mysqli_sql_exception $e) {
            $data[] = $e->getMessage();
        }

        return $data;
    }
}
