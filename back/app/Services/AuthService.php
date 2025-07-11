<?php

namespace App\Services;

use App\Dto\Auth\LoginDto;
use App\Dto\Auth\SignupDto;
use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    public function login(LoginDto $dto): string
    {
        $field = filter_var($dto->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (!Auth::attempt([$field => $dto->login, 'password' => $dto->password])) {
            throw ValidationException::withMessages([
                'login' => ['Invalid credentials.'],
            ]);
        }

        $user = Auth::user();
        $user->tokens()->delete();

        return $user->createToken('api-token', ['*'], now()->addWeek())->plainTextToken;
    }

    public function signup(SignupDto $dto)
    {
        $email = User::where('email', $dto->email)->first();
        $phone = User::where('phone', $dto->phone)->first();
        if ($email || $phone) {
            throw ValidationException::withMessages([]);
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
