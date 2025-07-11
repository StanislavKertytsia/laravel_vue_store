<?php

namespace App\Http\Requests\Auth;

use App\Dto\Auth\SignupDto;
use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'lastName' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'numeric', 'unique:users,phone'],
            'password' => ['required', 'string'],
        ];
    }

    public function toDto()
    {
        return new SignupDto(
            name: $this->input('name'),
            last_name: $this->input('lastName'),
            email: $this->input('email'),
            phone: $this->input('phone'),
            password: $this->input('password'),
        );
    }
}
