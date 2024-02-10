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
            'Rumah Sakit DL',
            'Lembaga Pemerintahan',
            'Instansi Swasta',
            'Masyarakat Umum'
        ];

        foreach ($data as $key => $value) {
            \DB::table('tujuan')->insert([
                'nama_tujuan' => $value,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
