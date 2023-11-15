<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenueSeeder extends Seeder
{

    public function run(): void
    {

        $venues = [
            [
                'id' => 1,
                'venue_name' => 'Music Hall',
                'city_state' => 'City, State',
                'address' => '123 Main Street',
                'phone' => '987-654-3210',
                'facebook_link' => 'https://www.facebook.com/musichall',
                'image' => 'musichall.jpg',
                'website_link' => 'https://www.musichall.com',
                'looking_for_talent' => true,
                'genres_id' => 1,
                'user_id' => 3,
            ],

        ];


        DB::table('venues')->insert($venues);
    }
}
