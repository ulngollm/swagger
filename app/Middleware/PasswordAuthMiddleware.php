<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpUnauthorizedException;

class PasswordAuthMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler)
    {
        $parsedBody = $request->getParsedBody();
        extract($parsedBody);
        $user = UserService::findExistsUser($login);
        $isValidPasswd = $user ? UserService::validatePassword($user, $password) : false;

        if ($isValidPasswd) {
            $jwt = JWTService::generateToken();
            $modifiedRequest = $request->withAttribute('token', $jwt);
            $response = $handler->handle($modifiedRequest);
            return $response;
        }
        throw new HttpUnauthorizedException($request);
    }
}