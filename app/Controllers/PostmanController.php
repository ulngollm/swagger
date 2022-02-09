<?php

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostmanController
{
    public function index(Request $request, Response $response)
    {
        $client = new Client();
        $externalUri = 'https://postman-echo.com/basic-auth';

        try {
            $result = $client->request(
                'GET',
                $externalUri,
                ['headers' => $request->getHeaders()]
            );
            $status = $result->getStatusCode();
        } catch (Exception $e) {
            $response->getBody()->write($e->getMessage());
            $status = $e->getCode();
            return $response->withStatus($status);
        }

        //if status == 200
        $body = $result->getBody()->getContents();
        $response->getBody()->write($body);
        $contentType = $result->getHeader('Content-Type');
        return $response->withStatus($status)->withHeader('Content-Type', $contentType);
    }
}