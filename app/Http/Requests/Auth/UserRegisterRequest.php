<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:70', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'country_id.required' => 'Country is required',
            'country_id.integer' => 'Country must be an integer',
            'country_id.exists' => 'Country does not exist',
            'first_name.required' => 'First name is required',
            'first_name.string' => 'First name must be a string',
            'first_name.max' => 'First name must be less than 50 characters',
            'last_name.required' => 'Last name is required',
            'last_name.string' => 'Last name must be a string',
            'last_name.max' => 'Last name must be less than 50 characters',
            'email.required' => 'Email is required',
            'email.string' => 'Email must be a string',
            'email.email' => 'Email must be a valid email',
            'email.max' => 'Email must be less than 70 characters',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 6 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ];
    }
}
