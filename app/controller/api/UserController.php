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

    public function getAllUsers(Request $req, Response $res): void
    {
        $data = $this->users->read(['id', 'username', 'email', 'password', 'role_id'], $this->table, ['1 = 1']);
        $this->users->close();
        $res->toJSON($data);
    }

    public function getOneUserById(Request $req, Response $res): void
    {
        $data = $this->users->read(['id', 'username', 'email', 'password', 'role_id', 'provider_id'], $this->table, ['id = ' . $req->params[0]]);
        $this->users->close();
        $res->toJSON($data);
    }

    public function createUser(Request $req, Response $res): void
    {
        $columns = ['username', 'email', 'password', 'role_id', 'provider_id'];
        $data = $this->users->create($this->table, $columns, $req->getJSON($columns));
        $this->users->close();
        $res->toJSON($data);
    }

    public function updateUser(Request $req, Response $res): void
    {
        $columns = ['username', 'email', 'password', 'role_id', 'provider_id'];
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

    public function loginUser(Request $req, Response $res): void
    {
        $columns = ['email', 'password'];
        $value = $req->getJSON($columns);

        $sql = $this->users->read(['provider_id'], $this->table, ['email = ' . '"' . $value['email'] . '"']);

        $data = new StdClass();

        //  Check if provider is traditional or using oauth.
        if (isset($sql[0]->provider_id)) {
            if ($sql[0]->provider_id == 1) {
                // TODO: HASH PASSWORD
                $sql_1 = $this->users->read(['email'], $this->table, ['password = ' . '"' . $value['password'] . '"']);

                if (isset($sql_1[0]->email)) {
                    $payload = new stdClass();
                    $payload->email = $value['email'];
                    $payload->role = 2;
                    $jwt = Token::generateToken($payload);
                    setcookie("token", $jwt, path: "/", httponly: true);
                    $data->message = "Login successful!";
                    $res->toJSON($data);
                } else {
                    $data->message = "You have entered an incorrect password.";
                    $res->toJSON($data, 401);
                }
            } else {
                $data->message = "You have registered using OAuth, please login with your provider.";
                $res->toJSON($data, 401);
            }
        } else {
            $data->message = "User account does not exist.";
            $res->toJSON($data, 401);
        }
//        $res->toJSON($data, 401);

//        if($value["email"] == $data["email"]) {
//            $res->toJSON($data);
//        }
//        else {
//            echo "no";
//        }
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

    public function logoutUser(Request $req, Response $res): void
    {
        setcookie('token', '', time() - 3600, '/', '', true);
        $data = new StdClass();
        $data->message = "logout successful";
        $res->toJSON($data);
    }

    public function verifyUser(Request $req, Response $res): void
    {
        $username = $this->checkTokenMiddleware($req, $res);
        $data = new StdClass();
        $data->isVerified = true;
        $data->username = $username;
        $res->toJSON($data);
    }

    public function checkTokenMiddleware(Request $req, Response $res): string
    {
        $isAuthenticated = false;
        $username = "";

        if (isset($_COOKIE['token'])) {
            $token = (string)$_COOKIE['token'];
            $data = Token::decodeToken($token);
            if (isset($data->email) && isset($data->role)) {
                $sql = $this->users->read(['username', 'email', 'role_id', 'provider_id'], $this->table, ['email = ' . "'" . $data->email . "'"]);
                $this->users->close();
                if (isset($sql[0]->username)) {
                    $username = $sql[0]->username;
                    $isAuthenticated = true;
                }
            }
        }
        if (!$isAuthenticated) {
            $data = new StdClass();
            $data->isVerified = false;
            $res->toJSON($data);
            exit();
        }
        return $username;
    }
}
