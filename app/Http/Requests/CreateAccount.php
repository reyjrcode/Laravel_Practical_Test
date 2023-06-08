<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class CreateAccount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'string|max:255',
            'lastname' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'max:255|unique:users',
            'password' => 'required|string|min:6'
        ];
    }
    /**
     * Summary of messages
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.unique' => 'Email already existed',
            'username.unique' => 'Username already used',
            'password.required' => 'Password is required'
        ];
    }
    /**
     * Summary of messages
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'password' => Hash::make($this->password)
        ]);
    }
}