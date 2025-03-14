<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;

class AuthController extends BaseController
{
    public function signin(Request $request)
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
    public function signout(Request $request)
    {
        if (Auth::check()) {
            $request->user()->tokens()->delete();
        }

        return response()->json(['message' => 'Successfully logged out']);
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
            'status' => 'required',
            'role' => 'required',
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
        $user = User::create($input);
        $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User created successfully.');
    }
    public function editUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'role' => 'required',
            'name' => 'required',
            'username' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'sometimes|required|min:6', // Password is optional, but if provided, it should meet the minimum length requirement.
            'confirm_password' => 'sometimes|required_with:password|same:password', // Confirm password only required if password is provided.
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        $user = User::findOrFail($id);
        $userData = $request->except('password', 'confirm_password');

        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->input('password'));
        }

        $user->update($userData);

        return $this->sendResponse([], 'User updated successfully.');
    }

}
