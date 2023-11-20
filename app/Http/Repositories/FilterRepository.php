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
                $query->orderBy('start_date', 'asc', $request->start_date);
            });
            return ShowResource::collection($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }
}
