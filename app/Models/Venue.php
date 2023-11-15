<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_name',
        'city_state',
        'address',
        'phone',
        'genres_id',
        'facebook_link',
        'image',
        'website_link',
        'looking_for_talent',
        'user_id',
    ];

    public function users()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genres::class);
    }

    public function shows()
    {
        return $this->hasMany(Show::class);
    }
}
