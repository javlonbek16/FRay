<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    use HasFactory;
    protected $fillable = [
        'gener_name'
    ];

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }

    public function venues()
    {
        return $this->belongsToMany(Venue::class);
    }
}
