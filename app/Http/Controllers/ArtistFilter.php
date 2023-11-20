<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ArtistFilterInterface;


class ArtistFilter extends Controller
{

    public function __construct(public ArtistFilterInterface  $artistFilterRepository)
    {
    }
    public function showArtist($id)
    {
        return   $this->artistFilterRepository->showArtist($id);
    }

    public function artistCompleteShows($artist_id)
    {
        return   $this->artistFilterRepository->artistCompleteShows($artist_id);
    }

    public function artistIncompleteShows($artist_id)
    {
        return   $this->artistFilterRepository->artistIncompleteShows($artist_id);
    }

}


