<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
    // relasi antrian - survei
    public function survei()
    {
        return $this->hasMany(Survei::class);
    }
}
