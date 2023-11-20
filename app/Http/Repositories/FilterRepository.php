<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\FilterInterface;
use App\Http\Resources\ShowResource;
use App\Models\Show;
use Illuminate\Http\Request;

class FilterRepository implements FilterInterface{
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

            return ShowResource::collection($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

}
