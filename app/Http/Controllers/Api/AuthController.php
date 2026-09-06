<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 🔐 LOGIN FUNCTION
    public function login(Request $request)
    {
        // STEP 1: check credentials
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // STEP 2: get user
        $user = Auth::user();

        // STEP 3: generate token
        $token = $user->createToken('api-token')->plainTextToken;

        // STEP 4: return response
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    // 🚪 LOGOUT FUNCTION
    public function logout(Request $request)
    {
        // delete current token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}