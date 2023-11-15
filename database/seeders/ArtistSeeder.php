<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistSeeder extends Seeder
{

    public function run(): void
    {

        $artists = [
            [
                'id' => 1,
                'artist_name' => 'John Doe',
                'city_state' => 'City, State',
                'phone' => '123-456-7890',
                'facebook_link' => 'https://www.facebook.com/johndoe',
                'image' => 'john_doe.jpg',
                'website_link' => 'https://www.johndoe.com',
                'looking_for_concert' => true,
                'genres_id' => 1,
                'user_id' => 2,
            ],

        ];

        DB::table('artists')->insert($artists);
    }
}
