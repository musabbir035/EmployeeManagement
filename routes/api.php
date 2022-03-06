<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeEducationController;
use App\Http\Controllers\EmployeeExperienceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('auth-check', [AuthController::class, 'authCheck']);
    Route::put('users/edit', [UserController::class, 'edit']);
    Route::post('users/change-password', [AuthController::class, 'changePassword']);

    Route::get('employees', [EmployeeController::class, 'index']);
    Route::post('employees/store', [EmployeeController::class, 'store']);
    Route::get('employees/{id}', [EmployeeController::class, 'show']);
    Route::put('employees/{id}/update', [EmployeeController::class, 'update']);
    Route::delete('employees/{id}/delete', [EmployeeController::class, 'destroy']);

    Route::post('educations/store', [EmployeeEducationController::class, 'store']);
    Route::put('educations/{id}/update', [EmployeeEducationController::class, 'update']);
    Route::delete('educations/{id}/destroy', [EmployeeEducationController::class, 'destroy']);

    Route::post('experiences/store', [EmployeeExperienceController::class, 'store']);
    Route::put('experiences/{id}/update', [EmployeeExperienceController::class, 'update']);
    Route::delete('experiences/{id}/destroy', [EmployeeExperienceController::class, 'destroy']);
});
