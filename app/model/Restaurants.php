<?php namespace App\Model;

use App\Lib\Config;
use App\Lib\QueryBuilder;
use mysqli;
use stdClass;

class Restaurants
{
    public static function getAll()
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "inf1005-alpha";

        // Create connection
        $mysqli = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        } else {
            $query = (new QueryBuilder())
                ->select('id', 'name')
                ->from('restaurants');

            $result = $mysqli->query($query);

            $data = array();
            while ($row = $result->fetch_object()) {
                $data[] = $row;
            }

            $mysqli->close();

            return $data;
        }
    }

    public static function getOne() {}

    public static function add() {}

    public static function update() {}

    public static function delete() {}

}
