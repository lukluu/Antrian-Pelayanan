<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function antrians()
    {
        return $this->hasMany(Antrian::class);
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }
}
