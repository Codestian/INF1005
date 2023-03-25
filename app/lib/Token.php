<?php namespace App\Lib;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token {

    private static $secretKey = "secret";

    public static function generateToken($data): string
    {
        $payload = array(
            "data" => $data,
            "exp" => time() + 3600 // Expires in 1 hour
        );

        $jwt = JWT::encode($payload, self::$secretKey, 'HS256');
        return $jwt;
    }

    public static function decodeToken($jwt) {
        try {
            $decoded = JWT::decode($jwt, new Key(self::$secretKey, 'HS256'));
            return $decoded->data;
        } catch (Exception $e) {
            return null;
        }
    }
}
