<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProfileController
{

    public function index(Request $request, ResponseInterface $response, $args)
    {
        $data = [
            'id' => $args['id'],
            'name' => 'Tony',
            'gender' => 'male',
        ];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

}