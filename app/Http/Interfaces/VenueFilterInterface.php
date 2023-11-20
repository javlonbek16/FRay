<?php

namespace App\Http\Interfaces;


interface VenueFilterInterface
{
    public function  index();
    public function venueCompleteShows($venue_id);
    public function showVenue($id);
    public function venueIncompleteShows($venue_id);
}
