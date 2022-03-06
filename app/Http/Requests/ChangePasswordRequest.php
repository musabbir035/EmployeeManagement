<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Wrong current password.');
                }
            }],
            'new_password' => 'required|min:8|max:255|string',
            'confirm_new_password' => 'required|string|same:new_password'
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'Password must contain {min} characters.',
            'new_password.max' => 'Password must not contain more than {max} characters.',
            'confirm_new_password.required' => 'Please confirm your new password.',
            'confirm_new_password.same' => 'New passwords do not match.',
        ];
    }
}
