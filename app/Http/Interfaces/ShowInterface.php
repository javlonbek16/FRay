<?php

namespace App\Http\Interfaces;

use App\Models\Show;


interface ShowInterface
{
    public function getAllShows();

    public function createShow($data);

    public function getShowById(int $id);

    public function updateShow(Show $show, array $data);

    public function deleteShow(Show $show);
    public function getCompletedShows();

    public function getUnCompletedShows();
    
    public function updateIsComplete();
}
