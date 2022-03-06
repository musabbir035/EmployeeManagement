<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return response()->json([
            'employees' => EmployeeResource::collection(Employee::all())
        ], 200);
    }

    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());
        return response()->json([
            'employee' => new EmployeeResource($employee),
            'message' => 'Employee added.'
        ], 200);
    }

    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->validated());

        return response()->json([
            'employee' => new EmployeeResource($employee),
            'message' => 'Employee updated.'
        ], 200);
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return response()->json([
            'employee' => new EmployeeResource($employee)
        ], 200);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted.'
        ], 200);
    }
}
