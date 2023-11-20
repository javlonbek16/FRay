<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\FilterInterface;
use App\Http\Resources\ShowResource;
use App\Models\Show;
use Illuminate\Http\Request;

class FilterRepository implements FilterInterface
{
    public function getShows(Request $request)
    {
        try {
            $data = Show::with([
                'artists',
                'venues',
            ])->when($request->start_date, function ($query) use ($request) {
                $query->orderBy('start_date', $request->start_date == 'desc' ? 'desc' : 'asc');
            })->when($request->is_complete, function ($query) use ($request) {
                $query->where('is_complete', $request->is_complete == true ? true : false);
            })->when($request->artist_name, function ($query)   use ($request) {
                $query->where('artist_name', 'like', '%' . $request->artist_name . '%');;
            })->when($request->venue_name, function ($query) use ($request) {
                $query->where('venue_name', 'like', '%' . $request->venue_name . '%');
            });
            return ShowResource::collection($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }
}
