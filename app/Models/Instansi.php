<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $fillable = [
       'nama_instansi',
       'alamat',
       'logo',
    ];
    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'id_instansi', 'id');
    }
}
