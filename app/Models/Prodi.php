<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';
    protected $fillable = [
        'nama_prodi',
    ];

    // Relationship to User
    public function users()
    {
        return $this->hasMany(User::class, 'prodi_id');
    }
}
