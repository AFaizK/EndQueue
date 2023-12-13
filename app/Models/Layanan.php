<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_instansi',
       'nama_layanan',
       'kode_layanan',
    ];
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id');
    }
}
