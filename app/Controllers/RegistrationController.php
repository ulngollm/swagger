<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RegistrationController
{
    public function index(Request $request, Response $response)
    {
        $parsedBody = $request->getParsedBody();
        extract($parsedBody);

        $user = UserService::findExistsUser($login);
        if (!$user) {
            UserService::addUser(...$parsedBody);
            $result = ['token' => JWTService::generateToken()];
            $response->getBody()->write(json_encode($result));
            return $response->withHeader('Content-Type', 'application/json');
        } else {
            $response->getBody()->write('User is exists');
            return $response;
        }
    }
}