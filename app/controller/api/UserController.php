<?php namespace App\Controller\Api;

use App\Lib\Request;
use App\Lib\Response;
use App\Lib\Token;
use App\Model\Users;
use mysqli;
use stdClass;

class UserController
{
    private Users $users;
    private string $table = 'user';

    public function __construct(mysqli $mysqli)
    {
        $this->users = new Users($mysqli);
    }



    public function registerUser(Request $req, Response $res): void
    {
        $columns = ['email', 'username', 'password'];
        $value = $req->getJSON($columns);

        $sql = $this->users->read(['id', 'email'], $this->table, ['email = ' . '"' . $value['email'] . '"']);

        $data = new StdClass();

        if (isset($sql[0]->email)) {
            $data->message = "User account exists, please login.";
            $res->toJSON($data, 409);
        } else {
            $sql_1 = $this->users->read(['id', 'username'], $this->table, ['username = ' . '"' . $value['username'] . '"']);
            if (isset($sql_1[0]->username)) {
                $data->message = "Username taken, please select another.";
                $res->toJSON($data, 409);
            } else {
                // TODO: HASH PASSWORD
                $columns = ['username', 'email', 'password', 'role_id', 'provider_id'];
                $sql_2 = $this->users->create($this->table, $columns, [$value['username'], $value['email'], $value['password'], 2, 1]);

                $payload = new stdClass();
                $payload->email = $value['email'];
                $payload->role = 2;
                $jwt = Token::generateToken($payload);
                setcookie("token", $jwt, path: "/", httponly: true);

                $data->message = $sql_2[0];
                $res->toJSON($data);
            }
        }
        $this->users->close();
    }

}
