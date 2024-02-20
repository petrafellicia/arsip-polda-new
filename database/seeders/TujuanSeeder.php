<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Rumah Sakit DL' => 'Jalan Ksatria 9',
            'Lembaga Pemerintahan' => 'Jalan Ringroad Utara',
            'Instansi Swasta' => 'Jalan Panembahan 6',
            'Masyarakat Umum' => 'Jalan Tugu Mas'
        ];

        foreach ($data as $nama_tujuan => $alamat_tujuan) {
            \DB::table('tujuan')->insert([
                'nama_tujuan' => $nama_tujuan,
                'alamat_tujuan' => $alamat_tujuan,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
