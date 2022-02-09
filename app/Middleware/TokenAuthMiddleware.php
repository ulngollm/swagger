<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpUnauthorizedException;

abstract class TokenAuthMiddleware
{
    protected function extractTokenFromHeader(Request $request): string
    {
        $header = $request->getHeaderLine('Authorization');
        return trim(str_replace(['Basic', 'Bearer'], '', $header));
    }

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);
        if ($request->hasHeader('Authorization')) {
            $token = $this->extractTokenFromHeader($request);
            if ($this->isValidToken($token)) {
                return $response;
            }
        }
        throw new HttpUnauthorizedException($request);
    }

    abstract protected function isValidToken(string $token): bool;
}