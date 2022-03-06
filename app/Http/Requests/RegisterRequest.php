<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:8|max:255',
                'name' => 'required|string|max:255'
            ];
        } else {
            return [
                'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
                'name' => 'required|string|max:255'
            ];
        }
    }

    public function messages()
    {
        return [
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address belongs to another user.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Password must contain {min} characters.',
            'password.max' => 'Password must not contain more than {max} characters.',
            'name' => 'Please enter a name.'
        ];
    }
}
