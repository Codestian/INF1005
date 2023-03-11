<?php namespace App\Lib;

use mysqli;

class Database {
    public static function connect() {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "inf1005-alpha";

        // Create connection
        $mysqli = new mysqli($servername, $username, $password, $database);
    }
}


