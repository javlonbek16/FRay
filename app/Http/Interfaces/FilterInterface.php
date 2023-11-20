<?php

namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface FilterInterface
{
    public function getShows(Request $request);
}
