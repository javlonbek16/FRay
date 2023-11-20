<?php

namespace App\Http\Interfaces;


interface  ArtistFilterInterface
{
    public function artistIncompleteShows($artist_id);
    public function showArtist($id);
    public function artistCompleteShows($artist_id);
}
