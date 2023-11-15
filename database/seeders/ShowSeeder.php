<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShowSeeder extends Seeder
{
    public function run(): void
    {
        $shows = [
            [
                'artist_id' => 1,
                'venue_id' => 1,
                'start_date' => '2023-01-01 18:00:00',
                'end_date' => '2023-01-01 22:00:00',
                'is_complete' => false,
            ]
        ];


        DB::table('shows')->insert($shows);
    }
}
