<?php

namespace App\Controller;

use App\Lib\AbstractController;
use App\Lib\Model;
use App\Lib\Request;
use App\Lib\Response;

class RestaurantController extends AbstractController
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
        UserController::adminOnlyMiddleware($this->model, $req, $res);
        parent::deleteRow($req, $res);
    }
}