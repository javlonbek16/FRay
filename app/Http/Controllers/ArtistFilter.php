<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Show;
use Illuminate\Http\Request;

class ArtistFilter extends Controller
{
    private function artist()
    {
        return Artist::with(['shows']);
    }

    public function artistCompleteShows($artist_id)
    {
        return $this->artist()->find($artist_id)->shows()
            ->where('is_complete', true)->paginate(5);
    }

    public function artistIncompleteShows($artist_id)
    {
        return  $this->artist()->find($artist_id)->shows()
            ->where('is_complete', false)->paginate(5);
    }

    public function getShows(Request $request)
    {
        try {
            $order = $request->input('order', 'asc');
            $searchTerm = $request->input('search', '');

            $data = Show::with([
                'artists',
                'venues',
                
            ])->when($searchTerm, function ($query) use ($searchTerm) {
                $query->whereHas('venues', function ($query) use ($searchTerm) {
                    $query->where('venue_name', 'like', '%' . $searchTerm . '%');
                })
                    ->orWhereHas('artists', function ($query) use ($searchTerm) {
                        $query->where('artist_name', 'like', '%' . $searchTerm . '%');
                    });
            })->select(
                'id',
                'artist_id',
                'venue_id',
                'start_date',
                'end_date',
                'is_complete'
            )->orderBy('start_date', $order == 'desc' ? 'desc' : 'asc')->paginate(5);

            return $data;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }
}

// GET /filter?order=start_date&search=John
