<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\FilterInterface;

use Illuminate\Http\Request;

class FilterController extends Controller
{

    public function __construct(public FilterInterface $filterInterface)
    {
    }
    public function getShows(Request $request)
    {
        return $this->filterInterface->getShows($request);
    }
}

// GET /filter?order=start_date&search=John
