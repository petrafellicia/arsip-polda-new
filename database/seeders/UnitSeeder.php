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
            'KAURREN',
            'KAURJARKOM',
            'KAURPULATAH',
            'Bid Siber',
            'Bid Tekinfo'
        ];

        foreach ($data as $key => $value) {
        \DB::table('unit_penerima')->insert([
            'nama_unit' => $value,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
    }
}
