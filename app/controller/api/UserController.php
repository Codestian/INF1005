<?php namespace App\Controller\Api;

use App\Lib\Request;
use App\Lib\Response;
use App\Model\Users;
use mysqli;

class UserController
{
    private Users $users;
    private string $table ='user';
    public function __construct(mysqli $mysqli) {
        $this->users = new Users($mysqli);
    }

    public function getAllUsers(Request $req, Response $res): void
    {
        $data = $this->users->read(['id', 'username', 'email', 'password', 'role_id'], $this->table, ['1 = 1']);
        $this->users->close();
        $res->toJSON($data);
    }
    public function getOneUserById(Request $req, Response $res): void
    {
        $data = $this->users->read(['id', 'username', 'email', 'password', 'role_id'], $this->table, ['id = ' . $req->params[0]]);
        $this->users->close();
        $res->toJSON($data);
    }
    public function createUser(Request $req, Response $res): void
    {
        $columns = ['username', 'email', 'password', 'role_id', 'provider'];
        $data = $this->users->create($this->table, $columns, $req->getJSON($columns));
        $this->users->close();
        $res->toJSON($data);
    }
    public function updateUser(Request $req, Response $res): void
    {
        $columns = ['username', 'email', 'password', 'role_id'];;
        $value = $req->getJSON($columns);

        $merged = array_map(function ($key, $val) {
            return "$key = '$val'";
        }, $columns, $value);

        $data = $this->users->update($this->table, $merged, ['id = ' . $req->params[0]]);
        $this->users->close();
        $res->toJSON($data);
    }
    public function deleteUser(Request $req, Response $res): void
    {
        $data = $this->users->delete($this->table, ['id = ' . $req->params[0]]);
        $this->users->close();
        $res->toJSON($data);
    }

    public function loginUser(Request  $req, Response $res) {
//        $data = $this->users->read(['id', 'username', 'email', 'password', 'role_id'], $this->table, ['id = ' . $req->params[0]]);

    }
}
