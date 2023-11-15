<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "venue name" => $this->venues->venue_name,
            "artist name" => $this->artists->artist_name,
            "show start date" => $this->start_date,
            "show end date" => $this->end_date,
            "is accept" => $this->is_accept ? 'accepted' : 'pending',
        ];
    }
}
