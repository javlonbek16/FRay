<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
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
        return $this->belongsTo(User::class, 'id');
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
