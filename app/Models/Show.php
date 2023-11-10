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
        return $this->hasMany(Artist::class, 'id');
    }

    public function venues()
    {
        return $this->hasMany(Venue::class, 'id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'id');
    }
}
