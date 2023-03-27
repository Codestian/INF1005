<?php namespace App\Controller\Api;

use App\Lib\Request;
use App\Lib\Response;
use App\Model\Roles;
use mysqli;

class RoleController
{
    private Roles $roles;
    private string $table ='role';
    public function __construct(mysqli $mysqli) {
        $this->roles = new roles($mysqli);
    }

    public function getAllRoles(Request $req, Response $res): void
    {
        $data = $this->roles->read(['id', 'name'], $this->table, ['1 = 1']);
        $this->roles->close();
        $res->toJSON($data);
    }
    public function getOneRoleById(Request $req, Response $res): void
    {
        $data = $this->roles->read(['id', 'name'], $this->table, ['id = ' . $req->params[0]]);
        $this->roles->close();
        $res->toJSON($data);
    }
    public function createRole(Request $req, Response $res): void
    {
        $columns = ['name'];;
        $data = $this->roles->create($this->table, $columns, $req->getJSON($columns));
        $this->roles->close();
        $res->toJSON($data);
    }
    public function updateRole(Request $req, Response $res): void
    {
        $columns = ['name'];
        $value = $req->getJSON($columns);

        $merged = array_map(function ($key, $val) {
            return "$key = '$val'";
        }, $columns, $value);

        $data = $this->roles->update($this->table, $merged, ['id = ' . $req->params[0]]);
        $this->roles->close();
        $res->toJSON($data);
    }
    public function deleteRole(Request $req, Response $res): void
    {
        $data = $this->roles->delete($this->table, ['id = ' . $req->params[0]]);
        $this->roles->close();
        $res->toJSON($data);
    }
}