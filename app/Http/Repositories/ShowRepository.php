<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ShowInterface;

use App\Models\Show;


class ShowRepository implements ShowInterface
{


    public function getAllShows()
    {
        return Show::with(['artists', 'venues'])->paginate(15);
    }

    public function createShow($request)
    {
        return Show::create($request);
    }

    public function getShowById(int $id)
    {
        return Show::findOrFail($id);
    }

    public function updateShow(Show $show, array $data)
    {
        $show->update($data);
        return $show;
    }

    public function deleteShow(Show $show)
    {
        $show->delete();
    }

    public function getCompletedShows()
    {
        $date = date('Y-m-d H:i');
        return Show::whereDate('end_date', '<', $date)
            ->where('is_complete', false)
            ->get();
    }

    public function getUnCompletedShows()
    {
        $date = date('Y-m-d H:i');
        $completedShows = Show::whereDate('end_date', '>', $date)
            ->where('is_complete', false)
            ->get();
        return response()->json($completedShows);
    }

    public function updateIsComplete()
    {
        $date = date('Y-m-d H:i');

        $completedShows = Show::whereDate('end_date', '<', $date)
            ->where('is_complete', false)
            ->get();

        foreach ($completedShows as $show) {
            $show->is_complete = true;
            $show->save();
        }
    }
}
