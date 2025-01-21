<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillUser extends Model
{
    use HasFactory;

    protected $table = 'skilluser';
    protected $fillable = ['user_id', 'skill_id', 'pengajuan_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'skilluser_id');
    }
}
