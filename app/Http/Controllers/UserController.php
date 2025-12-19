<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function users(Request $request)
    {
        try {
            $users = User::all();
            return response()->json(['users' => $users], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Failed to retrieve users',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
