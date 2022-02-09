<?php

class JWTAuthMiddleware extends TokenAuthMiddleware
{
    protected function isValidToken(string $token): bool
    {
        return JWTService::verifyToken($token);
    }
}