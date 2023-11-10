<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ShowInterface;
use App\Http\Requests\StoreShowRequest;
use App\Models\Artist;
use App\Models\Venue;
use App\Utility\CheckIsComplate;
use Illuminate\Http\Request;



class ShowController extends Controller
{

    use CheckIsComplate;

    private $showRepository;

    public function __construct(ShowInterface $showRepository)
    {
        $this->showRepository = $showRepository;
    }

    public function index()
    {
        $shows = $this->showRepository->getAllShows();
        return $shows;
    }

    public function store(StoreShowRequest $request)
    {
        $user = auth()->user();
        $roleType = $user->role_type;


        $showData = [
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ];

        if ($roleType === 'venue') {
            $shows = $user->venue->shows;
            $showData['venue_id'] = $user->venue->id;
            $showData['artist_id'] = $request->input('artist_id');

            $artist_id = Artist::find($showData['artist_id']);
            return   $result = $this->checkIsComplate($artist_id, $showData);
        } elseif ($roleType === 'artist') {
            $shows = $user->artist->shows;
            $showData['venue_id'] = $request->input('venue_id');
            return   $showData['artist_id'] = $user->artist->id;

            $venue_id = Venue::find($showData['venue_id']);
            return $result = $this->checkIsComplate($venue_id, $showData);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (empty($showData['artist_id'])) {
            return response()->json(['error' => 'Invalid artist ID'], 400);
        }

        if (empty($showData['venue_id'])) {
            return response()->json(['error' => 'Invalid venue ID'], 400);
        }


        foreach ($shows as $show) {
            $isComplete = $show->is_complete;
            $end_date = $show->end_date;
            if ($isComplete == 1) {
                return response()->json(['error' => 'You already have a complete show for this date'], 400);
            } elseif ($isComplete != 1 && $end_date < $request->input('start_date')) {
                return response()->json(['error' => 'You have already booked a show for this date'], 400);
            }
        }
        if ($isComplete != 1) {
            return $this->showRepository->createShow($showData);
        } else {
            return response()->json(['error' => 'Invalid show conditions'], 400);
        }
    }

    public function show(int $id)
    {
        $show = $this->showRepository->getShowById($id);
        return $show;
    }

    public function update(Request $request, int $id)
    {
        $show = $this->showRepository->getShowById($id);
        $updatedData = $request->only(['start_date', 'end_date']);
        $show = $this->showRepository->updateShow($show, $updatedData);
        return $show;
    }

    public function destroy(int $id)
    {
        $show = $this->showRepository->getShowById($id);
        $this->showRepository->deleteShow($show);
        return response()->json(['message' => 'Show deleted successfully']);
    }

    public function getCompletedShows()
    {
        $show = $this->showRepository->getCompletedShows();
        return $show;
    }
    public function getUnCompletedShows()
    {
        $show = $this->showRepository->getUnCompletedShows();
        return $show;
    }
    public function updateIsComplete()
    {
        $this->showRepository->updateIsComplete();
        return response()->json(['message' => 'is_complete updated successfully']);
    }
}
