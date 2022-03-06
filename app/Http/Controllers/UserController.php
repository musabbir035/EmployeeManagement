<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit(RegisterRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());

        return response()->json([
            'user' => $user,
            'message' => 'Profile updated.'
        ], 200);
    }
}
