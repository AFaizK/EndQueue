<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PengunjungResource;
use App\Models\Pengunjung;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Pengunjung = Pengunjung::all();
        return PengunjungResource::collection($Pengunjung);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(Request $request)
    {
         // Validasi input
        $validatedData = $request->validate([
            'query' => 'required|string',
        ]);

        // Lakukan pencarian berdasarkan query yang diberikan
        $searchQuery = $validatedData['query'];

        $pengunjung = Pengunjung::where(function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('username', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%')
                ->orWhere('no_hp', 'like', '%' . $searchQuery . '%');
        })
        ->get();

        return response()->json(['data' => $pengunjung]);

    }
    public function pagination()
    {
        $pengunjungQuery = Pengunjung::query(); // Inisialisasi query builder
        $pengunjung = $pengunjungQuery->paginate(10); // Jalankan paginasi

        return PengunjungResource::collection($pengunjung)->additional([
            'meta' => [
                'pagination' => [
                    'total' => $pengunjung->total(), // Mendapatkan jumlah total sebelum paginasi
                    'count' => $pengunjung->count(),
                    'per_page' => $pengunjung->perPage(),
                    'current_page' => $pengunjung->currentPage(),
                    'total_pages' => $pengunjung->lastPage(),
                ],
            ],
        ]);
    }


}
