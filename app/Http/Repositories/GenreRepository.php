<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\GenreInterface;
use App\Http\Resources\GenreResource;
use App\Models\Genres;

class GenreRepository implements GenreInterface
{
    public function getAll()
    {
        $genres = Genres::all();
        return  GenreResource::collection($genres);
    }
    public function getById($id)
    {
        $genre = Genres::find($id);

        if (!$genre) {
            return response()->json(['error' => 'Genres not found'], 404);
        }

        return new GenreResource($genre);
    }
    public function create($request)
    {
        $genre = Genres::create($request);
        return  GenreResource::make($genre);
    }
    public function update(Genres $genre, array $request)
    {
        $genre->update($request);
    
        return new GenreResource($genre);
    }
    
    public function delete(Genres $id,)
    {
        $genre = Genres::find($id);
        if (!$genre) {
            return response()->json(['error' => 'Genres not found'], 404);
        }
        $genre->delete();
        return new GenreResource($genre);
    }
};
