<?php

namespace App\Http\Controllers;

use App\Models\Messages;

class MessageController extends Controller
{
    public function getMessage()
    {
        $user = auth()->user();
        if ($user->role_type == 'artist') {
            return   Messages::where("artist_id", $user->artist->id)
                ->with('venues', 'artists')
                ->orderBy("created_at", "desc")
                ->paginate(10);
        } elseif ($user->role_type == 'venue') {
            return   Messages::where("venue_id", $user->venue->id)
                ->with('venues', 'artists')
                ->orderBy("created_at", "desc")
                ->paginate(10);
        }
    }
}
