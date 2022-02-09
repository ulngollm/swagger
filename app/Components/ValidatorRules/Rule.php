<?php

abstract class Rule
{
    protected array $constraints;
    protected array $errorMessages;

    protected function writeError($type, $value = null)
    {
        $this->errors[] = $this->getErrorMessage($type, $value);
    }

    protected function getErrorMessage($type, $value = null)
    {
        return sprintf($this->errorMessages[$type], $value);
    }

    abstract public function execute($value);
}