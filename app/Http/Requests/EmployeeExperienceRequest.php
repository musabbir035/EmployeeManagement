<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeExperienceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'organization' => 'required|string|max:255',
            'from_date' => 'required|date_format:Y-m-d',
            'to_date' => 'required|date_format:Y-m-d|after:from_date',
            'designation' => 'required|string|max:255',
            'duties' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'organization.required' => 'Please enter organization name.',
            'from_date.required' => 'Please enter date from.',
            'from_date.date_format' => 'Date format should be: dd-mmm-yyyy (e.g. 12-Dec-2020).',
            'to_date.required' => 'Please enter date to.',
            'to_date.date_format' => 'Date format should be: dd-mmm-yyyy (e.g. 12-Dec-2020).',
            'to_date.after' => 'End date must be a date after start date.',
            'designation.required' => 'Please enter designation.',
            'duties.required' => 'Please enter duties.',
        ];
    }
}
