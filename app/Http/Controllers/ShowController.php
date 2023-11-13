<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ShowInterface;
use App\Http\Requests\StoreShowRequest;
use App\Utility\IsNeedTallent;

class ShowController extends Controller
{
    use IsNeedTallent;
    private $showRepository;

    public function __construct(ShowInterface $showRepository)
    {
        $this->showRepository = $showRepository;
    }

    public function index()
    {
        $shows = $this->showRepository->getAllShows();
        return $shows;
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

    public function getCompletedShows()
    {
        $show = $this->showRepository->getCompletedShows();
        return $show;
    }
    public function getUnCompletedShows()
    {
        $show = $this->showRepository->getUnCompletedShows();
        return $show;
    }

    public function updateIsComplete(){
        $show = $this->showRepository->updateIsComplete();
        return $show;  
    }
}
