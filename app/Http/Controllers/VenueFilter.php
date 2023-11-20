<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\VenueFilterInterface;


class VenueFilter extends Controller
{
    public function __construct(public VenueFilterInterface $venueFilter)
    {
    }
    public function  index()
    {
        return $this->venueFilter->index();
    }

    public function venueCompleteShows($venue_id)
    {
        return $this->venueFilter->venueCompleteShows($venue_id);
    }

    public function showVenue($id)
    {
        return $this->venueFilter->showVenue($id);
    }
    public function venueIncompleteShows($venue_id)
    {
        return $this->venueFilter->venueIncompleteShows($venue_id);
    }
}
