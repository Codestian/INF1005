<?php namespace App\Controller\Api;

namespace App\Controller\api;

use App\Lib\Request;
use App\Lib\Response;
use App\Model\Restaurants;
use mysqli;
class RestaurantController
{
    private Restaurants $restaurant;
    public function __construct(mysqli $mysqli) {
        $this->restaurant = new Restaurants($mysqli);
    }
    public function getAllRestaurants(Request $req, Response $res): void
    {
        $data = $this->restaurant->getAll();
        $res->toJSON($data);
    }
    public function getOneRestaurantById(Request $req, Response $res): void
    {
        $data = $this->restaurant->getOne($req->params[0]);
        $res->toJSON($data);
    }
    public function createRestaurant(Request $req, Response $res): void
    {
        $attributes = ['name', 'description', 'address'];
        $data = $this->restaurant->create($req->getJSON($attributes));
        $res->toJSON($data);
    }
    public function updateRestaurant(Request $req, Response $res): void
    {
        $attributes = ['name', 'description', 'address'];
        $data = $this->restaurant->update($req->params[0], $req->getJSON($attributes));
        $res->toJSON($data);
    }
    public function deleteRestaurant(Request $req, Response $res): void
    {
        $data = $this->restaurant->delete($req->params[0]);
        $res->toJSON($data);
    }
}