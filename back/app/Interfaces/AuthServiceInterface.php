<?php

namespace App\Interfaces;

interface AuthServiceInterface
{
    public function login(string $email, string $password): string;
}
