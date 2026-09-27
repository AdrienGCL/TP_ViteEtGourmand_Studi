<?php

namespace app\core;

class Csrf
{
    private const SESSION_KEY = 'csrf_token';

    public function __construct(
        private Session $session
    ) {
    }

    public function getToken(): string
    {
        $token = $this->session->get(self::SESSION_KEY);

        if ($token === null) {
            $token = bin2hex(random_bytes(32));
            $this->session->set(self::SESSION_KEY, $token);
        }

        return $token;
    }

    public function validate(?string $token): bool
    {
        $sessionToken = $this->session->get(self::SESSION_KEY);

        if ($sessionToken === null || $token === null) {
            return false;
        }

        return hash_equals($sessionToken, $token);
    }
}