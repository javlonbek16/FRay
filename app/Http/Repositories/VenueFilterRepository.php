<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\VenueFilterInterface;
use App\Http\Resources\ShowResource;
use App\Models\Venue;

class VenueFilterRepository implements VenueFilterInterface
{
    public function  index()
    {
        return Venue::paginate(10);
    }
    private function venues()
    {
        return Venue::with(['shows']);
    }

    public function venueCompleteShows($venue_id)
    {
        $data = $this->venues()->find($venue_id)
            ->shows()->with([
                'artists',
                'venues',
            ])
            ->where('is_complete', true)
            ->paginate(5);

        return ShowResource::collection($data);
    }


    public function showVenue($id)
    {
        $venue = Venue::with(['shows' => function ($query) {
            $query->with([
                'artists',
                'venues',
            ]);
        }])->find($id);

        if (!$venue) {
            return response()->json(['message' => 'Venue not found'], 404);
        }

        return ShowResource::collection($venue->shows);
    }
    public function venueIncompleteShows($venue_id)
    {
        $data = $this->venues()->find($venue_id)
            ->shows()->with([
                'artists',
                'venues',
            ])
            ->where('is_complete', false)
            ->paginate(5);
        return ShowResource::collection($data);
    }
}
