<?php namespace App\Controller\Api;

use App\Lib\Request;
use App\Lib\Response;
use App\Model\Items;
use mysqli;

class ItemController
{
    private Items $items;
    private string $table ='item';

    public function __construct(mysqli $mysqli) {
        $this->items = new Items($mysqli);
    }
    public function getAllItems(Request $req, Response $res): void
    {
        $data = $this->items->read(['id', 'name', 'description', 'price', 'restaurant_id'], $this->table, ['1 = 1']);
        $this->items->close();
        $res->toJSON($data);
    }
    public function getOneItemById(Request $req, Response $res): void
    {
        $data = $this->items->read(['id', 'name', 'description', 'price', 'restaurant_id'], $this->table, ['id = ' . $req->params[0]]);
        $this->items->close();
        $res->toJSON($data);
    }
    public function getAllItemsByRestaurantId(Request $req, Response $res): void
    {
        $data = $this->items->read(['id', 'name', 'description', 'price'], $this->table, ['restaurant_id = ' . $req->params[0]]);
        $this->items->close();
        $res->toJSON($data);
    }
    public function createItem(Request $req, Response $res): void
    {
        $columns = ['name', 'description', 'price', 'restaurant_id'];
        $data = $this->items->create($this->table, $columns, $req->getJSON($columns));
        $this->items->close();
        $res->toJSON($data);
    }
    public function updateItem(Request $req, Response $res): void
    {
        $columns = ['name', 'description', 'price', 'restaurant_id'];
        $value = $req->getJSON($columns);

        $merged = array_map(function ($key, $val) {
            return "$key = '$val'";
        }, $columns, $value);

        $data = $this->items->update($this->table, $merged, ['id = ' . $req->params[0]]);
        $this->items->close();
        $res->toJSON($data);
    }
    public function deleteItem(Request $req, Response $res): void
    {
        $data = $this->items->delete($this->table, ['id = ' . $req->params[0]]);
        $this->items->close();
        $res->toJSON($data);
    }
}