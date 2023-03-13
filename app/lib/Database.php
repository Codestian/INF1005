<?php namespace App\Lib;

use mysqli;

//  Sets up database connection, needs to be only setup ONCE.
class Database {
    private mysqli $mysqli;
    public function __construct() {
        // TODO: PUT IN .env file
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "inf1005-alpha";

        // Create connection
        $this->mysqli = new mysqli($servername, $username, $password, $database);
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }
    public function getConnection(): mysqli
    {
        return $this->mysqli;
    }
}


