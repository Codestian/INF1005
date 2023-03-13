<?php namespace App\Controller\Api;

use App\Lib\Request;
use App\Lib\Response;
use App\Model\Users;

class UserController {
    public function __construct() {
//        parent::__construct();

    }

    public function getAllUsers(Request $req, Response $res): void
    {
        $user = new Users();
        $user->getAll();
//        $res->toJSON($data);
    }
}