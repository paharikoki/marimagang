<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'skill';
    protected $fillable = [
        'bidang_id',
        'databidang_id',
        'nama',
    ];

    public function databidang()
    {
        return $this->belongsTo(DataBidang::class, 'databidang_id');
    }

    public function skilluser()
    {
        return $this->hasMany(SkillUser::class, 'skill_id');
    }
}
