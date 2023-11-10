<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\GenreInterface;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;


class GenresController extends Controller
{
    public function __construct(public GenreInterface  $genreRepository)
    {
    }
    public function index()
    {
        return $this->genreRepository->getAll();
    }

    public function store(StoreGenreRequest $request)
    {
        return $this->genreRepository->create($request->validated());
    }

    public function show($id)
    {
        return $this->genreRepository->getById($id);
    }

    public function update(UpdateGenreRequest $request, $id)
    {
        return $this->genreRepository->update($request->validated(), $id);
    }

    public function destroy($id)
    {
        return $this->genreRepository->delete($id);
    }
}
