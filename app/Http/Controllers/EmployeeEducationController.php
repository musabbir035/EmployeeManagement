<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeEducationRequest;
use App\Http\Resources\EmployeeEducationResource;
use App\Models\EmployeeEducation;

class EmployeeEducationController extends Controller
{
    public function store(EmployeeEducationRequest $request)
    {
        $education = EmployeeEducation::create($request->validated());

        return response()->json([
            'education' => new EmployeeEducationResource($education),
            'message' => 'Education added.'
        ], 200);
    }

    public function update(EmployeeEducationRequest $request, $id)
    {
        $education = EmployeeEducation::findOrFail($id);
        $education->update($request->validated());

        return response()->json([
            'education' => new EmployeeEducationResource($education),
            'message' => 'Education updated.'
        ], 200);
    }

    public function destroy($id)
    {
        $education = EmployeeEducation::findOrFail($id);
        $education->delete();

        return response()->json([
            'message' => 'Education deleted.'
        ], 200);
    }
}
