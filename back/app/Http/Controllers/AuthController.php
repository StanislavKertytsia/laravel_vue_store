<?php

namespace App\Http\Controllers;

use App\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthServiceInterface $authService
    )
    {
    }

    public function login(Request $request)
    {

        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string'
        ]);

        $token = $this->authService->login($request->login, $request->password);
        
        return response()->json([
            'token' => $token,
        ]);
    }

}
