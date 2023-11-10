<?php

namespace App\Http\Interfaces;

use App\Models\Genres;

interface GenreInterface
{
    public function getAll();

    public function create(array $request);

    public function getById(int $id);

    public function update(Genres $show, array $data);

    public function delete(Genres $show);
}
