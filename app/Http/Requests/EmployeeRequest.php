<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'roll' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11|unique:employees',
            'email' => 'required|email|max:255|unique:employees',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['phone'] = [
                'required',
                'string',
                'max:11',
                'unique:employees,phone,' . $this->id
            ];
            $rules['email'] = [
                'required',
                'email',
                'max:255',
                'unique:employees,email,' . $this->id
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'roll.required' => 'Please enter a roll.',
            'name.required' => 'Please enter a name.',
            'phone.required' => 'Please enter a phone number.',
            'phone.unique' => 'This phone number belongs to another employee.',
            'phone.max' => 'Please enter a valid phone number.',
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address belongs to another employee.',
            'designation.required' => 'Please enter a designation.',
            'department.required' => 'Please enter a department.',
        ];
    }
}
