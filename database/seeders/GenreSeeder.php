<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run(): void
    {

        $genres = [
            ['id' => 1, 'gener_name' => 'Clasic'],
            ['id' => 2, 'gener_name' => 'Pop'],
            ['id' => 3, 'gener_name' => 'Jazz'],
            ['id' => 4, 'gener_name' => 'Opera'],
        ];

        DB::table('genres')->insert($genres);
    }
}
