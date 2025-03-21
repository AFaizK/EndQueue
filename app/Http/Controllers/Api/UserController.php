<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return UserResource::collection($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $User = User::create($request->all());

        return new UserResource($User);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request,User $User)
    {
        // dd($request->all());
        $User->update($request->all());
        return new UserResource($User);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        $User->delete();

        return response(null, 204);
    }

    public function search(Request $request)
    {
         // Validasi input
        $validatedData = $request->validate([
            'query' => 'required|string',
        ]);

        // Lakukan pencarian berdasarkan query yang diberikan
        $searchQuery = $validatedData['query'];

        $user = User::where(function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('username', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%')
                ->orWhere('role', 'like', '%' . $searchQuery . '%')
                ->orWhere('status', 'like', '%' . $searchQuery . '%')
                ->orWhere('no_hp', 'like', '%' . $searchQuery . '%');
        })
        ->get();

        return response()->json(['data' => $user]);

    }
    public function pagination()
    {
        $userQuery = User::query();
        $user = $userQuery->paginate(10);
        return UserResource::collection($user)->additional([
            'meta' => [
                'pagination' => [
                    'total' => $user->total(),
                    'count' => $user->count(),
                    'per_page' => $user->perPage(),
                    'current_page' => $user->currentPage(),
                    'total_pages' => $user->lastPage(),
                ],
            ],
        ]);
    }
}
