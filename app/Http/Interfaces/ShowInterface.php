<?php

namespace App\Http\Interfaces;

use App\Http\Requests\StoreShowRequest;

interface ShowInterface
{
    public function getAllShows();

    public function createShow(StoreShowRequest $data);

    public function getShowById(int $id);

    public function deleteShow(int $id);
    
    public function updateIsComplete();
}
