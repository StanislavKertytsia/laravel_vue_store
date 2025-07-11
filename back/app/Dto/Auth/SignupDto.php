<?php

namespace App\Dto\Auth;


class SignupDto
{
    public function __construct(
        public string $name,
        public string $last_name,
        public string $email,
        public string $phone,
        public string $password,
    )
    {
    }
}
