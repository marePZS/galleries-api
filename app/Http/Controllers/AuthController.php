<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Http\Requests\RegisterRequest;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $userData = $request->validated();
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);
        $token = auth('api')->login($user);

        return [
            'token' => $token,
            'user' => $user
        ];
    }

    public function login(Request $request)
    {
        $credentials = 
        [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $token = auth('api')->attempt($credentials);
        if (!$token) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        return 
        [
            'token' => $token,
            'user' => auth('api')->user()
        ];
    }

    public function logout()
    {
        $result = auth('api')->logout();
        return response()->json(['logout' => true]);
    }

    public function me()
    {
        return auth('api')->user();
    }

    public function refreshToken()
    {
        $token = auth('api')->refresh();
        return [
            'token' => $token
        ];
    }

}  
