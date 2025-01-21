<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $fillable = [
        'user_id',
        'databidang_id',
        'deskripsi',
        'bukti',
        'pengantar',
        'proposal',
        'cv',
        'laporan',
        'suratmagang',
        'kesbangpol',
        'tanggalmulai',
        'tanggalselesai',
        'status',
        'komentar',
        'dokumentasi',
        'nilai',
        'kesediaan'
    ];

    public function getTanggalLogbookAttribute()
    {
        try {
            $startDate = Carbon::parse($this->attributes['tanggalmulai']);
            $endDate = Carbon::parse($this->attributes['tanggalselesai']);

            $logbook = [];

            while ($startDate->lte($endDate)) {
                if ($startDate->isWeekday()) {
                    $logbook[] = $startDate->copy()->toDateString(); 
                }

                $startDate->addDay();
            }

            return $logbook;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getTanggalmulaiAttribute($value)
    {
        return $value ? Carbon::parse($value)->isoFormat('D MMMM YYYY') : null;
    }

    public function getTanggalselesaiAttribute($value)
    {
        return $value ? Carbon::parse($value)->isoFormat('D MMMM YYYY') : null;
    }

    public function skilluser()
    {
        return $this->hasMany(SkillUser::class, 'pengajuan_id');
    }

    public function databidang()
    {
        return $this->belongsTo(DataBidang::class, 'databidang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'pengajuan_id');
    }

    public function logbook()
    {
        return $this->belongsTo(Logbook::class, 'pengajuan_id');
    }
}
