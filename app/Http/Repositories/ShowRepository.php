<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ShowInterface;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;
use App\Http\Resources\ShowResource;
use App\Models\Show;
use App\Utility\IsNeedTallent;
use Carbon\Carbon;

class ShowRepository implements ShowInterface
{
    use IsNeedTallent;

    private function getBaseQuery()
    {
        return Show::with(['artists', 'venues']);
    }

    public function getAllShows()
    {
        $shows = $this->getBaseQuery()->paginate(15);
        return ShowResource::collection($shows);
    }

    public function createShow(StoreShowRequest $request)
    {
        $user = auth()->user();
        $roleType = $user->role_type;
        
        $showData = [
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ];

        if ($roleType === 'venue') {
            $showData['venue_id'] = $user->venue->id;
            $showData['artist_id'] = $request->input('artist_id');
        } elseif ($roleType === 'artist') {
            $showData['venue_id'] = $request->input('venue_id');
            $showData['artist_id'] = $user->artist->id;
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (empty($showData['artist_id'])) {
            return response()->json(['error' => 'Invalid artist ID'], 400);
        }

        if (empty($showData['venue_id'])) {
            return response()->json(['error' => 'Invalid venue ID'], 400);
        }

        $show = $this->isNeedTallent($showData);
        return $show;
    }

    public function getShowById(int $id)
    {
        $show = $this->getBaseQuery()->findOrFail($id);
        return ShowResource::make($show);
    }

    public function updateShow(UpdateShowRequest $request, int $id)
    {
        $show = $this->getShowById($id);
        $updatedData = $request->validated();
        $show->update($updatedData);

        return ShowResource::make($show);
    }

    public function deleteShow(int $id)
    {
        $show = $this->getShowById($id);
        $show->delete();

        return new ShowResource($show);
    }

    private function getShowsByDateAndCompletion($date, $isComplete)
    {
        return $this->getBaseQuery()
            ->whereDate('end_date', $isComplete ? '<' : '>', $date)
            ->where('is_complete', $isComplete)
            ->paginate(15);
    }

    public function getCompletedShows()
    {
        return ShowResource::collection($this->getShowsByDateAndCompletion(Carbon::now(), true));
    }

    public function getUncompletedShows()
    {
        return ShowResource::collection($this->getShowsByDateAndCompletion(Carbon::now(), false));
    }

    public function updateIsComplete()
    {
        $date = Carbon::now();

        $completedShows = $this->getShowsByDateAndCompletion($date, true);

        foreach ($completedShows as $show) {
            $show->is_complete = true;
            $show->save();
        }

        return ShowResource::collection($completedShows);
    }
}
