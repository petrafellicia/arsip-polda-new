<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model{
    use HasFactory;

    protected $table = 'surat_keluar';
    protected $guarded = [];

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat');
    }

    public function pengirim()
    {
        return $this->belongsTo(Unit::class, 'pengirim');
    }

    public function penerima(){
        return $this->belongsTo(TujuanSurat::class, 'tujuan');
    }

    public function kka()
    {
        return $this->belongsTo(KKA::class, 'kka');
    }


    protected $fillable = [
        'nomor_agenda',
        'nomor_surat',
        'jenis_surat',
        'pengirim',
        'perihal',
        'kka',
        'dasar_surat',
        'tanggal_surat',
        'jam_surat',
        'tujuan',
        'feedback',
        'file_name'
    ];
}
