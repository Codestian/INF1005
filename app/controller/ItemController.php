<?php

namespace App\Controller;

use App\Lib\AbstractController;
use App\Lib\Request;
use App\Lib\Response;

class ItemController extends AbstractController
{
    public function createRow(Request $req, Response $res): void {
        UserController::noNormalAllowedMiddleware($this->model, $req, $res);
        parent::createRow($req, $res);
    }

    public function updateRow(Request $req, Response $res): void {
        UserController::noNormalAllowedMiddleware($this->model, $req, $res);
        parent::updateRow($req, $res);
    }

    public function deleteRow(Request $req, Response $res): void {
        UserController::noNormalAllowedMiddleware($this->model, $req, $res);
        parent::deleteRow($req, $res);
    }

    public function getAllRowsByRestaurantId(Request $req, Response $res): void
    {
        $data = $this->model->read(['id', 'name', 'description', 'price'], $this->table, ['restaurant_id = ' . $req->params[0]]);
        $this->model->close();
        $res->toJSON($data);
    }
}