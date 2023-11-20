<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ArtistFilterInterface;
use App\Http\Resources\ShowResource;
use App\Models\Artist;

class ArtistFilterRepository implements ArtistFilterInterface
{
    public function  index()
    {
        return Artist::paginate(10);
    }
    private function artist()
    {
        return Artist::with(['shows']);
    }

    public function showArtist($id)
    {
        $artist = Artist::with(['shows' => function ($query) {
            $query->with([
                'artists',
                'venues',
            ]);
        }])->find($id);

        if (!$artist) {
            return response()->json(['message' => 'Artist not found'], 404);
        }

        return ShowResource::collection($artist->shows);
    }
    public function artistCompleteShows($artist_id)
    {
        $data = $this->artist()->find($artist_id)->shows()->with([
            'artists',
            'venues',
        ])
            ->where('is_complete', true)->paginate(5);
        return ShowResource::collection($data);
    }
    public function artistIncompleteShows($artist_id)
    {
        $data =  $this->artist()->find($artist_id)->shows()->with([
            'artists',
            'venues',
        ])
            ->where('is_complete', false)->paginate(5);
        return ShowResource::collection($data);
    }
}
