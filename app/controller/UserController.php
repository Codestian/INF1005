<?php

namespace App\Controller;

use App\Lib\AbstractController;
use App\Lib\Model;
use App\Lib\Request;
use App\Lib\Response;
use App\Lib\Token;
use stdClass;

class UserController extends AbstractController
{
    public function getAllRows(Request $req, Response $res): void {
        UserController::adminOnlyMiddleware($this->model, $req, $res);
        parent::getAllRows($req, $res);
    }
    public function getOneRowById(Request $req, Response $res): void {
        UserController::adminOnlyMiddleware($this->model, $req, $res);
        parent::getOneRowById($req, $res);
    }
    public function createRow(Request $req, Response $res): void {
        UserController::adminOnlyMiddleware($this->model, $req, $res);
        parent::createRow($req, $res);
    }

    public function updateRow(Request $req, Response $res): void {
        UserController::adminOnlyMiddleware($this->model, $req, $res);
        parent::updateRow($req, $res);
    }

    public function deleteRow(Request $req, Response $res): void {
        UserController::adminOnlyMiddleware($this->model, $req, $res);
        parent::deleteRow($req, $res);
    }
    public function loginUser(Request $req, Response $res): void
    {
        $columns = ['email', 'password'];
        $value = $req->getJSON($columns);

        $sql = $this->model->read(['provider_id'], $this->table, ['email = ' . '"' . $value['email'] . '"']);

        $data = new StdClass();

        //  Check if provider is traditional or using oauth.
        if (isset($sql[0]->provider_id)) {
            if ($sql[0]->provider_id == 1) {
                // TODO: HASH PASSWORD
                $sql_1 = $this->model->read(['email'], $this->table, ['password = ' . '"' . $value['password'] . '"']);

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
    }

    public function registerUser(Request $req, Response $res): void
    {
        $columns = ['email', 'username', 'password', 'role_id'];
        $value = $req->getJSON($columns);

        $sql = $this->model->read(['id', 'email', 'provider_id'], $this->table, ['email = ' . '"' . $value['email'] . '"']);

        $data = new StdClass();

        if (isset($sql[0]->email)) {
            if($sql[0]->provider_id !== 1) {
                $data->message = "You have registered with OAuth, please login.";
            }
            else {
                $data->message = "User account exists, please login.";
            }
            $res->toJSON($data, 409);
        }
        else {
            $sql_1 = $this->model->read(['id', 'username'], $this->table, ['username = ' . '"' . $value['username'] . '"']);
            if (isset($sql_1[0]->username)) {
                $data->message = "Username taken, please select another.";
                $res->toJSON($data, 409);
            } else {
                // TODO: HASH PASSWORD
                $columns = ['username', 'email', 'password', 'role_id', 'provider_id'];
                $sql_2 = $this->model->create($this->table, $columns, [$value['username'], $value['email'], $value['password'], $value['role_id'], 1]);

                $data->message = $sql_2->message;

                $res->toJSON($data);
            }
        }
        $this->model->close();
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
        $obj = $this->checkTokenMiddleware($this->model, $req, $res, 200);
        $data = new StdClass();
        $data->isVerified = true;
        $data->username = $obj->username;
        $data->id = $obj->id;
        $res->toJSON($data);
    }

    public static function checkTokenMiddleware(Model $model, Request $req, Response $res, int $status): stdClass
    {
        $isAuthenticated = false;
        $obj = new StdClass();

        if (isset($_COOKIE['token'])) {
            $token = (string)$_COOKIE['token'];
            $data = Token::decodeToken($token);
            if (isset($data->email) && isset($data->role)) {
                $sql = $model->read(['id', 'username', 'role_id'], 'user', ['email = ' . "'" . $data->email . "'"]);
                if (isset($sql[0]->username)) {
                    $obj->username = $sql[0]->username;
                    $obj->id = $sql[0]->id;
                    $obj->role = $sql[0]->role_id;
                    $isAuthenticated = true;
                }
            }
        }
        if (!$isAuthenticated) {
            $data = new StdClass();
            $data->isVerified = false;
            $res->toJSON($data, $status);
            exit();
        }
        return $obj;
    }

    public static function adminOnlyMiddleware(Model $model, Request $req, Response $res) {
        $obj = UserController::checkTokenMiddleware($model ,$req, $res, 401);

        if($obj->role != 1) {
            $data = new StdClass();
            $data->isAdmin = false;
            $res->toJSON($data, 403);
            exit();
        }
    }
}