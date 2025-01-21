<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Logbook extends Model
{
    use HasFactory;

    protected $table = 'logbooks';
    protected $fillable = [
        'user_id',
        'pengajuan_id',
        'tanggal',
        'kegiatan',
    ];

    public function pengajuan()
    {
        return $this->hasOne(Pengajuan::class, 'pengajuan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
