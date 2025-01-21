<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Spatie\Permission\Traits\HasRoles;


class Admin extends Model
{
    use HasFactory;
    use HasRoles;

    protected $table = 'admins';
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    public function databidang()
    {
        return $this->hasOne(DataBidang::class);
    }
}
