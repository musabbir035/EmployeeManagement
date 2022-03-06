<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (!Auth::attempt(['email' => $email, 'password' => $password], $request->has('remember'))) {
            return response()->json([
                'message' => 'Wrong credentials.'
            ], 422);
        }

        $token = Auth::user()->createToken('auth_token')->plainTextToken;

        return response([
            'user' => Auth::user(),
            'auth_token' => $token
        ], 200);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->safe()->except('password') + [
            'password' => Hash::make($request->input('password'))
        ]);
        Auth::login($user, true);

        $token = Auth::user()->createToken('auth_token')->plainTextToken;

        return response([
            'user' => Auth::user(),
            'auth_token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->where('id', Auth::user()->currentAccessToken()->id)->delete();

        return response(['message' => trans('messages.success')], 200);
    }

    public function authCheck()
    {
        if (Auth::check()) {
            return response()->json([
                'user' => Auth::user()
            ], 200);
        }
        return response()->json(['message' => 'Failed'], 401);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json([
            'message' => 'Password changed.'
        ], 200);
    }
}
