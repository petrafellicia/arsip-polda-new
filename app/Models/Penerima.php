<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_penerima'
    ];

    public function surat_masuks()
    {
        return $this->hasMany(SuratMasuk::class);
    }

    public function surat_keluars()
    {
        return $this->hasMany(SuratKeluar::class);
    }
}
