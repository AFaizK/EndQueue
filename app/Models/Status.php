<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    // protected $table = 'user_role';
    protected $fillable = [
        'status',
    ];
    public function user()
    {
        return $this->hasMany(User::class, 'status_id', 'id');
    }
}
