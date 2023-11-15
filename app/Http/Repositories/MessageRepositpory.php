<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\MessageInterface;
use App\Http\Resources\MessageResource;
use App\Http\Resources\ShowResource;
use App\Models\Messages;
use App\Models\Show;

class MessageRepositpory  implements MessageInterface
{

    public function getMessage()
    {
        $user = auth()->user();
        if ($user->role_type == 'artist') {
            $message =   Messages::where("artist_id", $user->artist->id)
                ->with('artists', 'venues')
                ->orderBy("created_at", "desc")
                ->paginate(10);

            return MessageResource::collection($message);
        } elseif ($user->role_type == 'venue') {
            $message = Messages::where("venue_id", $user->venue->id)
                ->with('artists', 'venues')
                ->orderBy("created_at", "desc")
                ->paginate(10);
            return MessageResource::collection($message);
        } else {
            return response()->json(['error' => 'You don\'t have any messages'], 404);
        }
    }

    public function acceptShow($id)
    {
        $user = auth()->user();
        $message = Messages::with('artists', 'venues')
            ->find($id);

        if (!$message)
            return response()->json(['error' => 'Message not found'], 404);

        if ($user->id ==  $message->author_id)
            return response()->json(['message' => 'You are the owner of this message you can\'t accept this show']);

        $startDate = $message->start_date;
        $endDate = $message->end_date;
        $venue_id = $message->venue_id;
        $artist_id = $message->artist_id;

        if (
            $user->role_type == 'artist' &&
            $artist_id === $user->artist->id &&
            $message->is_accept == false
        ) {
            $message->is_accept = true;
            $message->save();

            $showData  = [
                'venue_id' => $venue_id,
                'artist_id' => $artist_id,
                'start_date' => $startDate,
                'end_date' => $endDate
            ];

            $show = Show::create($showData);

            return  ShowResource::make($show);
        } elseif (
            $user->role_type == 'venue'
            && $venue_id === $user->venue->id
            && $message->is_accept == false
        ) {

            $message->is_accept = true;
            $message->save();

            $showData  = [
                'venue_id' => $venue_id,
                'artist_id' => $artist_id,
                'start_date' => $startDate,
                'end_date' => $endDate
            ];

            $show = Show::create($showData);

            return  ShowResource::make($show);
        }

        return response()->json(['message' => 'This message not  for you or already accepted, there is  nothing  YOU CAN DOO!!!']);
    }

    public function rejectShow($id)
    {
        $message = Messages::with('artists', 'venues')
        ->find($id);
    if (!$message)
        return response()->json(['error' => 'Message not found'], 404);

    $message->delete();
    return response()->json(['message' => 'Message rejected'], 404);
    }

    public function  acceptedShows() {
        $user = auth()->user();
        if ($user->role_type == 'artist') {
            $message =   Messages::where("artist_id", $user->artist->id)
                ->where("is_accept", true)
                ->with('artists', 'venues')
                ->orderBy("created_at", "desc")
                ->paginate(10);

            return MessageResource::collection($message);
        } elseif ($user->role_type == 'venue') {
            $message = Messages::where("venue_id", $user->venue->id)
                ->where("is_accept", true)
                ->with('artists', 'venues')
                ->orderBy("created_at", "desc")
                ->paginate(10);
            return MessageResource::collection($message);
        } else {
            return response()->json(['error' => 'You don\'t have any messages'], 404);
        }
    }
}
