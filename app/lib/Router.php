<?php namespace App\Lib;

class Router
{
    public static function get($route, $callback): void
    {
        self::validateMethod($route, $callback, "GET");

    }
    public static function post($route, $callback): void
    {
        self::validateMethod($route, $callback, "POST");

    }
    public static function put($route, $callback): void
    {
        self::validateMethod($route, $callback, "PUT");

    }
    public static function delete($route, $callback): void
    {
        self::validateMethod($route, $callback, "DELETE");
    }
    private static function validateMethod($route, $callback, $method): void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], $method) !== 0) {
            return;
        }
        self::on($route, $callback);
    }

    private static function on($regex, $cb): void
    {
        //  I literally have no idea what this does.
        $params = $_SERVER['REQUEST_URI'];
        $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;
        $regex = str_replace('/', '\/', $regex);
        $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

        if ($is_match) {
            // first value is normally the route, lets remove it.
            array_shift($matches);
            // Get the matches as parameters.
            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);

            $cb(new Request($params), new Response());
        }
    }
}