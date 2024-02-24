<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LayananRequest;
use App\Http\Resources\LayananResource;
use App\Models\Layanan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Layanan = Layanan::with('instansi')->get();
        return LayananResource::collection($Layanan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LayananRequest $request)
    {
        $Layanan = Layanan::with('instansi')->create($request->all());

        return new LayananResource($Layanan);
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
    public function update(LayananRequest $request,Layanan $Layanan)
    {
        $Layanan->update($request->all());
        return new LayananResource($Layanan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $Layanan)
    {
        $Layanan->delete();

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

        $layanan = Layanan::whereHas('instansi', function ($pengunjungQuery) use ($searchQuery) {
            $pengunjungQuery->where('nama_instansi', 'like', '%' . $searchQuery . '%');
        })->orWhere('nama_layanan', 'like', '%' . $searchQuery . '%')
        ->orWhere('kode_layanan', 'like', '%' . $searchQuery . '%')
        ->with('instansi')
        ->get();

        return response()->json(['data' => $layanan]);
    }
    public function pagination()
    {
        $layanan = Layanan::with('instansi')->paginate(5);
        return LayananResource::collection($layanan)->additional([
            'meta' => [
                'pagination' => [
                    'total' => $layanan->total(),
                    'count' => $layanan->count(),
                    'per_page' => $layanan->perPage(),
                    'current_page' => $layanan->currentPage(),
                    'total_pages' => $layanan->lastPage(),
                ],
            ],
        ]);
    }
}
