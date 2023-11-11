<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "venue name" => $this->venues->venue_name,
            "artist name" => $this->artists->artist_name,
            "start date" => $this->start_date,
            "end date" => $this->end_date,
            "is_complete" => $this->is_complete ? 'unfinished' : 'finished',
        ];
    }
}
