<?php

class BasicAuthMiddleware extends TokenAuthMiddleware
{
    public array $accessList;

    public function __construct(array $accessList)
    {
        $this->accessList = $accessList;
    }

    protected function isValidToken(string $token): bool
    {
        foreach ($this->accessList as $user => $password) {
            $validToken = base64_encode("$user:$password");
            if ($token === $validToken) {
                return true;
            }
        }
        return false;
    }
}
