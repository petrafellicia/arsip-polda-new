<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'admin',
                'level' => 'admin',
                'username' => 'admin',
                'password' => \Hash::make('admin123'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'operator',
                'level' => 'operator',
                'username' => 'operator',
                'password' => \Hash::make('operator456'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ];
        foreach ($data as $key => $value) {
            \DB::table('users')->insert($value);
        }
    }
}
