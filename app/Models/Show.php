<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;
    protected $fillable = [
        'artist_id',
        'venue_id',
        'start_date',
        'end_date',
        'is_complete'
    ];

    public function artists()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function venues()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }
   
}
