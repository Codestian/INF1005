<?php

namespace App\Controller;

use App\Lib\AbstractController;
use App\Lib\Request;
use App\Lib\Response;

class ItemController extends AbstractController
{
    public function getAllItemsByRestaurantId(Request $req, Response $res): void
    {
//        $data = $this->model->read(['id', 'name', 'description', 'price'], $this->table, ['restaurant_id = ' . $req->params[0]]);
//        $this->model->close();
//        $res->toJSON($data);
    }
}