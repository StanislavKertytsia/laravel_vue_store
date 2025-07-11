<?php

namespace App\Http\Requests\Auth;

use App\Dto\Auth\LoginDto;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function toDto()
    {
        return new LoginDto(
            login: $this->input('login'),
            password: $this->input('password'),
        );
    }
}
