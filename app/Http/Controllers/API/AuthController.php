<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;


class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required:unique:users',
            'email' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole('user');
        $token = $user->createToken('appToken')->accessToken;
        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $token,
        ]);

    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // First attempt authentication
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Only get user AFTER successful authentication
            $user = Auth::user();
            $token = $user->createToken('appToken')->accessToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successfully',
                'user' => $user,
                'token' => $token
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unauthorized',
        ], 401);  // Added proper status code
    }
    public function logout(Request $request)
    {

        $user = Auth::user();
        $user->token()->revoke();
        return response()->json([
            'status' => true,
            'message' => 'Logout successfully',
            'user' => $user
        ]);
    }
}
