<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required',
            'username.string' => 'Username must be a string',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
        ];
    }
}
