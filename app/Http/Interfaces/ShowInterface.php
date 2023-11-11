<?php

namespace App\Http\Interfaces;

use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;

interface ShowInterface
{
    public function getAllShows();

    public function createShow(StoreShowRequest $data);

    public function getShowById(int $id);

    public function updateShow(UpdateShowRequest $show, int $id);

    public function deleteShow(int $id);
    
    public function getCompletedShows();

    public function getUnCompletedShows();
    
    public function updateIsComplete();
}
