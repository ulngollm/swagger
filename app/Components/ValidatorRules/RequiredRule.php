<?php

class RequiredRule extends Rule
{
    protected array $errorMessages = [
        'required' => "Property is required",
    ];

    public function __construct(bool $required = true)
    {
        $this->constraints = [
            'required' => $required
        ];
    }

    public function execute($value)
    {
        $type = 'required';
        $isValid = $this->constraints[$type] ? (bool)$value : true;
        if (!$isValid) {
            throw new Exception($this->getErrorMessage($type));
        }
    }
}
