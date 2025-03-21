<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function index(){
        return view('pages.page-login');
    }
    public function register(Request $request)
    {
        $request->validate([
            'status_id' => 'required|integer|max:20',
            'user_role_id' => 'required|integer|max:20',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'status_id' => $request->status_id,
            'user_role_id' => $request->user_role_id,
            'name' => $request->name,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('MyAuthApp')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);

    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $user = Auth::user();
    //         $token = $user->createToken('MyAuthApp')->plainTextToken;

    //         return response()->json([
    //             // 'token' => $token,
    //             'redirect' => url('/dashboard'),
    //         ]);
    //     } else {
    //         return response()->json(['message' => 'Unauthorized.'], 401);
    //     }
    // }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();

            // Check if the user status is active
            if ($user->status !== 'Aktif') {
                Auth::logout(); // Log out the user if status is not active
                return response()->json(['message' => 'Your account is inactive.'], 401);
            }

            $token = $user->createToken('MyAuthApp')->plainTextToken;

            return response()->json([
                'success' => true,
                'data' => [
                    'token' => $token,
                    'name' => $user->name,
                    'role' => $user->role,
                ],
                'message' => 'User signed in',
                'redirect' => url('/dashboard'),
            ]);
        } else {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }
    }
    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully',

        ]);
    }

}
