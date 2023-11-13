<?php

namespace App\Utility;

use App\Http\Resources\ShowResource;
use App\Models\Artist;
use App\Models\Messages;
use App\Models\Venue;

trait IsNeedTallent
{
    public function isNeedTallent($showData)
    {
        $user = auth()->user();
        $roleType = $user->role_type;

        $venue = Venue::findOrFail($showData['venue_id']);
        $artist = Artist::findOrFail($showData['artist_id']);

        if ($roleType === 'artist') {
            $shows = $artist->shows;
            $showData['topic'] = "Dear Club director, I am Singer {$artist->name}. Can you join this show?";
        } elseif ($roleType === 'venue') {
            $shows = $venue->shows;
            $showData['topic'] = "Dear Singer, I am Club director {$venue->name}. Can you join this show?";
        } else {
            return response()->json(['error' => 'Invalid role type.'], 400);
        }

        if ($shows) {
            foreach ($shows as $show) {
                $isComplete = $show->is_complete;
                $end_date = $show->end_date;
                $start_date = $show->start_date;
            }
        }

        if ($isComplete != 1 && $end_date >= $showData['start_date'] && $showData['end_date'] >= $start_date){
            return response()->json([
                'message' => 'Your partner already has a show for your time, Please choose another time .'
            ], 400);
        }

        if (
            $artist->looking_for_concert != 0 &&
            $venue->looking_for_talent != 0
        ) {
            $show = $artist->shows()->create($showData);
            return  ShowResource::make($show);
        } else {

            Messages::create([
                'venue_id' => $venue->id,
                'artist_id' => $artist->id,
                'author_id' =>  $user->id,
                'topic' => $showData['topic'],
                'start_date' => $showData['start_date'],
                'end_date' => $showData['end_date'],
            ]);

            return response()->json([
                'message' => 'Your partner doesn\'t need a show at the moment, Your message has been sent to your partner. Please wait.'
            ], 200);
        }
    }
}
