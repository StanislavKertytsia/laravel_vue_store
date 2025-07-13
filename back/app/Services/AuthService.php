<?php

namespace App\Services;

use App\Dto\Auth\LoginDto;
use App\Dto\Auth\SignupDto;
use App\Interfaces\AuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthInterface
{
    public function login(LoginDto $dto)
    {
        $field = filter_var($dto->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (!Auth::attempt([$field => $dto->login, 'password' => $dto->password])) {
            throw ValidationException::withMessages([
                'login' => ['Invalid credentials.'],
            ]);
        }

        $user = Auth::user();
        $user->tokens()->delete();

        $token = $user->createToken('api-token', ['*'], now()->addWeek())->plainTextToken;
        return ['user' => $user, 'token' => $token];
    }

    public function signup(SignupDto $dto)
    {
        $userExists = User::where('email', $dto->email)
            ->orWhere('phone', $dto->phone)
            ->exists();

        if ($userExists) {
            throw ValidationException::withMessages([
                'login' => ['User already exists.'],
            ]);
        }

        $user = User::create([
            'name' => $dto->name,
            'last_name' => $dto->last_name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'password' => Hash::make($dto->password),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];

    }
}
