<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengunjung;

class AuthPengunjungController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $pengunjung = Pengunjung::create([
            'name' => $request->name,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $pengunjung->createToken('auth_token')->plainTextToken;

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
    //         $token = $user->createToken('auth_token')->plainTextToken;

    //         return response()->json([
    //             // 'token' => $token,
    //             'redirect' => url('/dashboard'),
    //         ]);
    //     } else {
    //         return response()->json(['message' => 'Unauthorized.'], 401);
    //     }
    // }
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('api_pengunjungs')->attempt($credentials)) {
    //         $pengunjung = Pengunjung::where('email', $request->email)->first();

    //         // Check if the pengunjung status is active

    //         $token = $pengunjung->createToken('auth_token')->plainTextToken;

    //         return response()->json([
    //             'redirect' => url('/booking'),
    //         ]);
    //     } else {
    //         return response()->json(['message' => 'Unauthorized.'], 401);
    //     }
    // }
    // public function logout(Request $request)
    // {
    //     Auth::user()->tokens()->delete();

    //     return response()->json([
    //         'message' => 'Logged out successfully',

    //     ]);
    // }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('api_pengunjungs')->attempt($credentials)) {
            $pengunjung = Pengunjung::where('email', $request->email)->first();

            // Check if the pengunjung status is active

            $token = $pengunjung->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'data' => [
                    'token' => $token,
                    'name' => $pengunjung->name,
                    'id' => $pengunjung->id,
                ],
                'message' => 'User signed in',
                'redirect' => url('/booking'),
            ]);
        } else {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user('api_pengunjungs')->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'User logged out successfully.'
        ]);
    }

}
