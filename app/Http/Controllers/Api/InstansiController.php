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
        $instansi = Instansi::paginate(4);
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstansiRequest $request)
    {
        $validatedData = $request->validated();

        // Simpan gambar ke penyimpanan publik
        $imagePath = $request->file('logo')->store('public/images');

        $instansi = Instansi::create([
            'nama_instansi' => $validatedData['nama_instansi'],
            'alamat' => $validatedData['alamat'],
            'logo' => $imagePath, // Simpan path gambar
        ]);

        return new InstansiResource($instansi);
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
    public function update(InstansiRequest $request, Instansi $instansi)
    {

        $validatedData = $request->validated();

        // Jika ada gambar baru, simpan gambar baru dan hapus yang lama
        if ($request->hasFile('logo')) {
            $newImagePath = $request->file('logo')->store('public/images');
            Storage::delete($instansi->logo);
            $instansi->logo = $newImagePath;
        }

        $instansi->update([
            'nama_instansi' => $validatedData['nama_instansi'],
            'alamat' => $validatedData['alamat'],

        ]);
        $instansi->save();
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
}
