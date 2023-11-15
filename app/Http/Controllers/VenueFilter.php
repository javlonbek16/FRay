<?php

namespace App\Http\Controllers;

use App\Models\Venue;

class VenueFilter extends Controller
{
    private function venues()
    {
        return Venue::with(['shows']);
    }

    public function venueCompleteShows($venue_id)
    {
        return $this->venues()->find($venue_id)
            ->shows()
            ->where('is_complete', true)
            ->paginate(5);
    }

    public function venueIncompleteShows($venue_id)
    {
        return $this->venues()->find($venue_id)
            ->shows()
            ->where('is_complete', false)
            ->paginate(5);
    }

}
