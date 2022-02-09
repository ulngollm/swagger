<?php

use Firebase\JWT\Key;
use Firebase\JWT\JWT;

class JWTService
{
    private const DEFAULT_KEY = 'key';

    private static function getSecretKeyFromEnv()
    {
        return $_ENV['SECRET_KEY'] ?? self::DEFAULT_KEY;
    }

    public static function generateToken()
    {
        $payload = array(
            "iss" => $_SERVER['SERVER_NAME'] ?? $_ENV['SERVER_NAME'],
            "iat" => time(),
            "nbf" => time(),
            "exp" => self::getExpiresTime(),
        );

        $key = self::getSecretKeyFromEnv();
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function verifyToken($token): bool
    {
        try {
            $key = self::getSecretKeyFromEnv();
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private static function getExpiresTime()
    {
        $timeLimit = 30 * 24 * 3600; //месяц
        return time() + $timeLimit;
    }
}