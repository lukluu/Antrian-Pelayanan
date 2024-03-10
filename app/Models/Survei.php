<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // relasi survei - antrain
    public function antrian()
    {
        return $this->belongsTo(Antrian::class);
    }
    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class); // Mengubah hasMany menjadi belongsTo
    }
}
