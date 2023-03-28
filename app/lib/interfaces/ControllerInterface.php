<?php namespace App\Lib\Interfaces;

use App\Lib\Model;
use App\Lib\Request;
use App\Lib\Response;

interface ControllerInterface {
    public function __construct(Model $model, string $table, array $columns);
    public function getAllRows(Request $req, Response $res): void;
    public function getOneRowById(Request $req, Response $res): void;
    public function createRow(Request $req, Response $res): void;
    public function updateRow(Request $req, Response $res): void;
    public function deleteRow(Request $req, Response $res): void;
}