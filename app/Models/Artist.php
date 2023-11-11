<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected  $fillable = [
        'artist_name',
        'city_state',
        'phone',
        'genres_id',
        'facebook_link',
        'image',
        'website_link',
        'looking_for_concert',
        'user_id',
    ];

    public function users()
    {
        return $this->hasOne(User::class);
    }
    public function genres()
    {
        return $this->hasMany(Genres::class,'genres_id');
    }
    public function shows()
    {
        return $this->hasMany(Show::class);
    }
}
