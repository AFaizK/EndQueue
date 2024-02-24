<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        // Mendapatkan data pengguna yang sudah login
        $user = Auth::user();

        // Mengirim data pengguna ke view
        return view('pages.edit-profile', compact('user'));
    }

    public function update(UserRequest $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Update user data
        $user->name = $request->name;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->no_hp = $request->no_hp;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        // Return a response
        return response()->json(['message' => 'Profile updated successfully']);
    }

    // public function update(UserRequest $request)
    // {
    //     // $user = Auth::user(); // Mengambil instance pengguna yang diautentikasi

    //     // Mendapatkan data yang diperbarui dari permintaan
    //     $userData = $request->validated();
    //     // dd($userdata);

    //     // Memperbarui atribut pengguna dengan data yang diperbarui
    //     $user->update($userData);

    //     // Mengembalikan instance pengguna yang telah diperbarui dalam bentuk sumber daya pengguna
    //     return new UserResource($userData);
    // }

    public function fetchData()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }
    }
}
