<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeEducationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'exam' => 'required|string|max:255',
            'result' => 'required|string|max:255',
            'result_scale' => 'required|string|max:255',
            'passing_year' => 'required|date_format:Y',
            'institution' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'exam.required' => 'Please enter examination name.',
            'result.required' => 'Please enter result.',
            'result_scale.required' => 'Please enter result scale.',
            'passing_year.required' => 'Please enter passing year.',
            'passing_year.date_format' => 'Please enter a valid year.',
            'institution.required' => 'Please enter institution name.',
        ];
    }
}
