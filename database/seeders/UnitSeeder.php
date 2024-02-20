<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'KAURREN' => 'Jalan Sleman Utara',
            'KAURJARKOM' => 'Jalan Sleman Utara',
            'KAURPULATAH' => 'Jalan Sleman Utara',
            'Bid Siber' => 'Jalan Ringroad Utara',
            'Bid Tekinfo' => 'Jalan Ringroad Utara'
        ];

        // foreach ($data as $key => $value) {
        foreach ($data as $nama_unit => $alamat_unit) {
            \DB::table('unit_penerima')->insert([
                'nama_unit' => $nama_unit,
                'alamat_unit' => $alamat_unit,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
