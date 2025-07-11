<?php

namespace App\Dto\Auth;


class LoginDto
{
    public function __construct(
        public string $login,
        public string $password,
    )
    {
    }
}
