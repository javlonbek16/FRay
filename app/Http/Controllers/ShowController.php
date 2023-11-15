<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ShowInterface;
use App\Http\Requests\StoreShowRequest;

class ShowController extends Controller
{
    
    private $showRepository;

    public function __construct(ShowInterface $showRepository)
    {
        $this->showRepository = $showRepository;
    }

    public function index()
    {
        return $this->showRepository->getAllShows();
    }

    public function store(StoreShowRequest $request)
    {
        return $this->showRepository->createShow($request);
    }

    public function show(int $id)
    {
        return $this->showRepository->getShowById($id);
    }

    public function destroy(int $id)
    {
        return $this->showRepository->deleteShow($id);
    }

    public function updateIsComplete()
    {
        return $this->showRepository->updateIsComplete();
    }
}
