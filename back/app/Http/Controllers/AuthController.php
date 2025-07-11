<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Interfaces\AuthServiceInterface;

class AuthController extends Controller
{
    public function __construct(
        protected AuthServiceInterface $authService
    )
    {
    }

    public function login(LoginRequest $request)
    {
        $dto = $request->toDto();

        $token = $this->authService->login($dto);

        return response()->json([
            'token' => $token,
        ]);
    }

    public function signup(SignUpRequest $request)
    {
        $dto = $request->toDto();

        $data = $this->authService->signup($dto);

        return response()->json([
            $data
        ], 201);
    }

}
