<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeExperienceRequest;
use App\Http\Resources\EmployeeExperienceResource;
use App\Models\EmployeeExperience;

class EmployeeExperienceController extends Controller
{
    public function store(EmployeeExperienceRequest $request)
    {
        $experience = EmployeeExperience::create($request->validated());

        return response()->json([
            'experience' => new EmployeeExperienceResource($experience),
            'message' => 'Experience added.'
        ], 200);
    }

    public function update(EmployeeExperienceRequest $request, $id)
    {
        $experience = EmployeeExperience::findOrFail($id);
        $experience->update($request->validated());

        return response()->json([
            'experience' => new EmployeeExperienceResource($experience),
            'message' => 'Experience added.'
        ], 200);
    }

    public function destroy($id)
    {
        $experience = EmployeeExperience::findOrFail($id);
        $experience->delete();

        return response()->json([
            'message' => 'Experience deleted.'
        ], 200);
    }
}
