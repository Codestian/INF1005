<?php namespace App\Controller\Api;

use App\Lib\Schema;
use App\Lib\Request;
use App\Lib\Response;
use App\Model\Restaurants;
use mysqli;
use stdClass;

class RestaurantController
{
    private Restaurants $restaurants;
    private string $table ='restaurant';

    public function __construct(mysqli $mysqli) {
        $this->restaurants = new Restaurants($mysqli);
    }
    public function getAllRestaurants(Request $req, Response $res): void
    {
        $data = $this->restaurants->read(['id', 'name', 'description', 'address', 'cuisine_id'], $this->table, ['1 = 1']);
        $this->restaurants->close();
        $res->toJSON($data);
    }
    public function getOneRestaurantById(Request $req, Response $res): void
    {
        $data = $this->restaurants->read(['id', 'name', 'description', 'address'], $this->table, ['id = ' . $req->params[0]]);
        $this->restaurants->close();
        $res->toJSON($data);
    }
    public function createRestaurant(Request $req, Response $res): void
    {
        $columns = ['name', 'description', 'address', 'cuisine_id'];
        $data = $this->restaurants->create($this->table, $columns, $req->getJSON($columns));
        $this->restaurants->close();
        $res->toJSON($data);
    }
    public function updateRestaurant(Request $req, Response $res): void
    {
        $columns = ['name', 'description', 'address', 'cuisine_id'];
        $value = $req->getJSON($columns);

        $merged = array_map(function ($key, $val) {
            return "$key = '$val'";
        }, $columns, $value);

        $data = $this->restaurants->update($this->table, $merged, ['id = ' . $req->params[0]]);
        $this->restaurants->close();
        $res->toJSON($data);
    }
    public function deleteRestaurant(Request $req, Response $res): void
    {
        $data = $this->restaurants->delete($this->table, ['id = ' . $req->params[0]]);
        $this->restaurants->close();
        $res->toJSON($data);
    }
}