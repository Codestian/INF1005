<?php namespace App\Lib;

use Exception;
use Firebase\JWT\JWT;

class Token {

    private static $secretKey = "my secret";

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
            $decoded = JWT::decode($jwt, self::$secretKey);

            return $decoded->data;
        } catch (Exception $e) {
            return null; // Invalid token
        }
    }


}

//                    $jwt1 = JWT::encode(["test@gmail.com"], "fmoeofeofe", 'HS256');

//                    $decoded = "";
//
//                    try {
//                        $decoded = JWT::decode($jwt1, new Key("secret", 'HS256'));
//                    }
//                    catch (SignatureInvalidException $e) {
//                        $decoded = $e->getMessage();
//                    }