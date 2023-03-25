<?php

namespace App\Lib;

use stdClass;

class Response
{
    public function status(int $code)
    {
        $this->status = $code;
        return $this;
    }

    public function toJSON($data = [], $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        $obj = new stdClass();
        $obj->status = $status;
        $obj->data = $data;
        echo json_encode($obj);
    }
}