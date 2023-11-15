<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
  
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'admin',
            'role_type' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
       
        DB::table('users')->insert([
            'id' => 2,
            'username' => 'eshmat',
            'role_type' => 'artist',
            'password' => Hash::make('123456'),
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'username' => 'toshmat',
            'role_type' => 'venue',
            'password' => Hash::make('123456'),
        ]);
    }
}
