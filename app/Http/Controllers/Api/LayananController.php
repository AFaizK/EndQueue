<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LayananRequest;
use App\Http\Resources\LayananResource;
use App\Models\Layanan;
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
    public function update(LayananRequest $request, Layanan $layanan)
    {
        $layanan->with('instansi')->update($request->all());

        return new LayananResource($layanan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return response(null, 204);
    }
}
