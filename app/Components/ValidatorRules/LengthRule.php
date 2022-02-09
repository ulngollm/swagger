<?php

class LengthRule extends Rule
{
    protected array $errorMessages = [
        'min' => "Value must containst at least %d symbols",
        'max' => "Value must containst max %d symbols",
        'equal' => "Value length must equal %d symbols"
    ];

    public function __construct(array $params)
    {
        foreach ($params as $type => $limit) {
            $this->constraints[$type] = $limit;
        }
    }

    public function execute($value)
    {
        foreach ($this->constraints as $type => $constraint) {
            $handlerName = "${type}Check";
            $isValid = $this->$handlerName($value, $constraint);
            if (!$isValid) {
                throw new Exception($this->getErrorMessage($type, $constraint));
            }
        }
    }

    private function minCheck($value, $constraint)
    {
        return strlen($value) >= $constraint;
    }

    private function maxCheck($value, $constraint)
    {
        return strlen($value) <= $constraint;
    }

    private function equalCheck($value, $constraint)
    {
        return strlen($value) === $constraint;
    }
}