<?php

class TypeRule extends Rule
{
    protected array $errorMessages = [
        'string' => "Expected type is a string",
        'int' => "Expected type is an integer",
        'float' => "Expected type is a float"
    ];

    public function __construct(string $type)
    {
        $this->constraints = [
            'type' => $type
        ];
    }

    public function execute($value)
    {
        $type = $this->constraints['type'];
        $handlerName = "${type}Check";
        $isValid = $this->$handlerName($value);
        if (!$isValid) {
            throw new Exception($this->getErrorMessage($type));
        }
    }

    private function intCheck($value)
    {
        return filter_var($value, FILTER_VALIDATE_INT);
    }

    private function stringCheck($value)
    {
        return (!filter_var($value, FILTER_VALIDATE_INT));
    }

    private function floatCheck($value)
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT);
    }

}