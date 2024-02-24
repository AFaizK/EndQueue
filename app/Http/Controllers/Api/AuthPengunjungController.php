<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Models\Pengunjung;

class AuthPengunjungController extends BaseController
{
    public function signin(Request $request)
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



    // public function signin(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $authUser = Auth::user();
    //         $name = $authUser->name;

    //         // Determine the response type based on the request
    //         if ($request->expectsJson()) {
    //             // If the request expects JSON, return JSON response
    //             return $this->sendResponse(['name' => $name], 'User signed in');
    //         } else {
    //             // If the request expects HTML, perform a web redirect
    //             return redirect('/dashboard');
    //         }
    //     } else {
    //         // Authentication failed
    //         if ($request->expectsJson()) {
    //             // If the request expects JSON, return JSON error response
    //             return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    //         } else {
    //             // If the request expects HTML, redirect back to login page with an error message
    //             return redirect('/login')->with('error', 'Invalid credentials');
    //         }
    //     }
    // }


    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $pengunjung = Pengunjung::create($input);
        $success['token'] = $pengunjung->createToken('MyAuthApp')->plainTextToken;
        $success['name'] = $pengunjung->name;

        return $this->sendResponse($success, 'User created successfully.');
    }


}
