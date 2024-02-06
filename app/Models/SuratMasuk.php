<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $table = 'surat_masuks';
    protected $table = 'surat_masuk';

    // public function scopeFilter($query, array $filters){
    //     $query->when($filters['search'] ?? false, function($query, $search){
    //         return $query->where('nomor_surat', 'LIKE', '%' .$search.'%')->paginate(5)
    //                     ->orWhere('kka', 'LIKE', '%' .$search.'%')->paginate(5);
    //     });
    // }

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat');
    }

    public function asal_surat()
    {
        return $this->belongsTo(Pengirim::class, 'asal_surat');
    }

    public function penerima(){
        return $this->belongsTo(Unit::class, 'penerima');
    }

    public function kka()
    {
        return $this->belongsTo(KKA::class, 'kka');
    }

    protected $fillable = [
        'nomor_agenda',
        'nomor_surat',
        'jenis_surat',
        'asal_surat',
        'perihal',
        'kka',
        'tanggal_surat',
        'jam_surat',
        'disposisi_kepada',
        'penerima',
        'isi_disposisi',
        'keterangan',
        'file_name'
    ];

    // public static function deleteDocument($id){
    //     $file = SuratMasuk::findorFail($id);

    //     dokumennsuratmasuk::delete($file->file_path);

    //     $file->delete();
    // }

}
