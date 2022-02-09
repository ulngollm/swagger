<?php


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Components\Controller;

class AuthController
{

    public function index(Request $request, Response $response)
    {
        $token = $request->getAttribute('token');
        $result = [
            'success' => true,
            'token' => $token,
        ];
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function logout(Request $request, Response $response, $args)
    {
        $result = [
            'success' => true,
        ];
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }

}
