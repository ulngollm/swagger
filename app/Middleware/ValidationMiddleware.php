<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;
use GuzzleHttp\Psr7\Response as Response;


class ValidationMiddleware
{
    private array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function __invoke(Request $request, RequestHandler $handler)
    {
        $data = $request->getParsedBody();
        $errors = $this->validateRequest($data);

        if ($errors) {
            return $this->returnErrorResponse($errors);
        }
        $response = $handler->handle($request);
        return $response;

    }

    private function validateRequest($data)
    {
        foreach ($this->rules as $property => $rules) {
            $value = $data[$property] ?? null;
            $error = $this->validateProperty($rules, $value);
            if ($error) {
                return [$property => $error];
            }
        }
    }

    private function validateProperty($rules, $value = null)
    {
        $validator = new Validator($rules);
        $validator->validate($value);
        return $validator->errors;
    }

    private function returnErrorResponse(array $errors)
    {
        $response = new Response();
        $result = ['error' => $errors];
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }

}