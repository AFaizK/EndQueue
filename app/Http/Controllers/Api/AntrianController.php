<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AntrianRequest;
use App\Http\Resources\AntrianResource;
use App\Models\Antrian;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $antrians = Antrian::with('pengunjung','layanan.instansi')->get();
        return AntrianResource::collection($antrians);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AntrianRequest $request)
    {
        $antrian = Antrian::create($request->all());

        return new AntrianResource($antrian);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $antrian = Antrian::findOrFail($id);
    //     return new AntrianResource($antrian);
    // }
    public function show($id_pengunjung)
    {
        // Mengambil data antrian berdasarkan ID pengguna
        $antrian = Antrian::with('pengunjung','layanan.instansi')->where('id_pengunjung', $id_pengunjung)->latest()->first();

        // Memeriksa apakah data antrian ditemukan
        if ($antrian) {
            // Mengembalikan data antrian dalam bentuk resource
            return new AntrianResource($antrian);
        } else {
            // Jika data antrian tidak ditemukan, mengembalikan response kosong dengan kode status 404
            return response()->json(['message' => 'Data antrian tidak ditemukan'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AntrianRequest $request, string $id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->update($request->all());

        return new AntrianResource($antrian);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'query' => 'required|string',
        ]);

        // Lakukan pencarian berdasarkan query yang diberikan
        $searchQuery = $validatedData['query'];

        $antrian = Antrian::whereHas('pengunjung', function ($pengunjungQuery) use ($searchQuery) {
            $pengunjungQuery->where('name', 'like', '%' . $searchQuery . '%');
        })->orWhereHas('layanan.instansi', function ($instansiQuery) use ($searchQuery) {
            $instansiQuery->where('nama_instansi', 'like', '%' . $searchQuery . '%');
        })->orWhere('nomor_antrian', 'like', '%' . $searchQuery . '%')
        ->orWhere('tanggal_antrian', 'like', '%' . $searchQuery . '%')
        ->with('pengunjung', 'layanan.instansi')
        ->get();

        return response()->json(['data' => $antrian]);
    }
    public function pagination()
    {
        $antrian = Antrian::with('pengunjung','layanan.instansi')->paginate(10);
        return AntrianResource::collection($antrian)->additional([
            'meta' => [
                'pagination' => [
                    'total' => $antrian->total(),
                    'count' => $antrian->count(),
                    'per_page' => $antrian->perPage(),
                    'current_page' => $antrian->currentPage(),
                    'total_pages' => $antrian->lastPage(),
                ],
            ],
        ]);
    }
}
