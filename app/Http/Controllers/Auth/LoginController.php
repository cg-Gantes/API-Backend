<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $userAccount = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (!Auth::attempt($userAccount)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $user = User::where('email', $userAccount['email'])->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Incorrect Email or Password',
                'error' => $th->getMessage()
            ], 401);
        }
    }
    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();

            return response()->json([
                'message' => 'Logout successful',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to logout',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
