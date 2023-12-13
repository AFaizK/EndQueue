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
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] = $authUser->name;

            return $this->sendResponse($success, 'User signed in');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
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
            'status_id' => 'required',
            'user_role_id' => 'required',
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

}
