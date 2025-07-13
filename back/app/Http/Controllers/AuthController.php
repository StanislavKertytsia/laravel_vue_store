<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Interfaces\AuthInterface;

class AuthController extends Controller
{
    public function __construct(
        protected AuthInterface $authService
    )
    {
    }

    public function login(LoginRequest $request)
    {
        $dto = $request->toDto();

        $response = $this->authService->login($dto);

        return response()->json($response, 200);
    }

    public function signup(SignUpRequest $request)
    {
        $dto = $request->toDto();

        $response = $this->authService->signup($dto);

        return response()->json(
            $response
            , 201);
    }

}
