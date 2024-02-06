<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class jenis_surat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            'Surat Biasa',
            'Nota Dinas',
            'Telegram',
            'Sprin',
            'Surat Izin',
            'Surat Rahasia'
        ];
        foreach ($jenis as $key => $value) {
            \DB::table('jenis_surat')->insert([
                'nama' => $value,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
