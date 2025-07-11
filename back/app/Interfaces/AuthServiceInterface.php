<?php

namespace App\Interfaces;

use App\Dto\Auth\LoginDto;
use App\Dto\Auth\SignupDto;

interface AuthServiceInterface
{
    public function login(LoginDto $dto);

    public function signup(SignupDto $dto);
}
