<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class InstansiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_instansi' => $this->nama_instansi,
            'alamat' => $this->alamat,
            'logo' => $this->logoUrl(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    // Menambahkan metode untuk mendapatkan URL gambar
    private function logoUrl()
    {
        return $this->logo ? url($this->logo) : null;
    }
}
