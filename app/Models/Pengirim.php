<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengirim extends Model
{
    use HasFactory;

    protected $table = 'pengirim';
    protected $fillable = [
        'nama_pengirim'
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
