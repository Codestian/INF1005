<?php

namespace App\Controller;

use App\Lib\AbstractController;
use App\Lib\Request;
use App\Lib\Response;

class RestaurantController extends AbstractController
{
    public function getAllRowsByRegionId(Request $req, Response $res): void
    {
        $data = $this->model->read(['id', 'name', 'description'], $this->table, ['region_id = ' . $req->params[0]]);
        $this->model->close();
        $res->toJSON($data);
    }
}