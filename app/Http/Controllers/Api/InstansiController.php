<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstansiRequest;
use App\Http\Resources\InstansiResource;
use App\Models\Instansi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instansi = Instansi::paginate(5);
        return InstansiResource::collection($instansi)->additional([
            'meta' => [
                'pagination' => [
                    'total' => $instansi->total(),
                    'count' => $instansi->count(),
                    'per_page' => $instansi->perPage(),
                    'current_page' => $instansi->currentPage(),
                    'total_pages' => $instansi->lastPage(),
                ],
            ],
        ]);
    }
    public function getAll()
    {
        $instansi = Instansi::all();
        return InstansiResource::collection($instansi);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(InstansiRequest $request)
    {
        $validatedData = $request->validated();

        // Simpan gambar ke penyimpanan publik
        $imagePath = $request->file('logo')->store('public/images');

        // Buat path lengkap
        $fullImagePath = 'storage/' . str_replace('public/', '', $imagePath);

        $instansi = Instansi::create([
            'nama_instansi' => $validatedData['nama_instansi'],
            'alamat' => $validatedData['alamat'],
            'logo' => $fullImagePath, // Simpan path gambar
        ]);

        return new InstansiResource($instansi);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instansi $instansi)
    {
        $instansi = Instansi::find($instansi);
        return InstansiResource::collection($instansi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstansiRequest $request, $id)
    {
        $validatedData = $request->validated();

        $instansi = Instansi::findOrFail($id);

        // Jika ada file logo yang diunggah, update gambar
        if ($request->hasFile('logo')) {
            // Hapus gambar lama
            if ($instansi->logo) {
                Storage::delete($instansi->logo);
            }

            // Simpan gambar baru
            $imagePath = $request->file('logo')->store('public/images');
            $fullImagePath = 'storage/' . str_replace('public/', '', $imagePath);

            $validatedData['logo'] = $fullImagePath;
        }

        // Update data instansi
        $instansi->update($validatedData);

        return new InstansiResource($instansi);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instansi $instansi)
    {
        $instansi->delete();

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

        $instansi = Instansi::where(function ($query) use ($searchQuery) {
            $query->where('nama_instansi', 'like', '%' . $searchQuery . '%')
                ->orWhere('alamat', 'like', '%' . $searchQuery . '%');
        })
        ->get();

        return response()->json(['data' => $instansi]);

    }
}
