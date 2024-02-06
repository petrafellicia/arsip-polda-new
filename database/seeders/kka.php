<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class kka extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'KEP',
            'BIN',
            'OPS',
            'REN',
            'LOG',
            'HUM',
            'HUK',
            'TIK',
            'TUK',
            'WAS',
            'KEU',
            'DIK',
            'PAM',
            'YAN',
            'KES',
            'RES',
        ];
        foreach ($data as $key => $value) {
            \DB::table('kka')->insert([
                'nama' => $value,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
