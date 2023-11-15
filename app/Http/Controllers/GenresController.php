<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\GenreInterface;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genres;

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
        $genre = Genres::find($id);

        if (!$genre) {
            return response()->json(['error' => 'Genre not found'], 404);
        }
        return $this->genreRepository->update($genre, $request->validated());
    }



    public function destroy($id)
    {
        return $this->genreRepository->delete($id);
    }
}
