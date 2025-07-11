<?php

namespace App\Services;

use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    public function login(string $email, string $password): string
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'message' => ['invalid credentials'],
            ]);
        }

        $user->tokens()->delete();

        return $user->createToken('api-token')->plainTextToken;
    }
}
