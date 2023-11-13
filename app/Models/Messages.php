<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = ['venue_id', 'artist_id', 'topic', 'author_id', 'start_date', 'end_date'];


    public function artists()
    {
        return $this->hasMany(Artist::class, 'id');
    }

    public function venues()
    {
        return $this->hasMany(Venue::class, 'id');
    }
}
