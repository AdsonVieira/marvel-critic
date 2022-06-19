<?php

namespace App\Services;

use App\Models\Movie;

use Illuminate\Database\RecordsNotFoundException;

class MovieService
{

    public function find($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            throw new RecordsNotFoundException('Filme não foi encontrado');
        }

        return $movie;
    }

    public function getAll()
    {
        return Movie::simplePaginate(10);
    }

    public function store($name, $synopsis, $thumbnailUrl) : Movie
    {
        $movie = new Movie();
        $movie->name = $name;
        $movie->synopsis = $synopsis;
        $movie->thumbnail_url = $thumbnailUrl;
        $movie->save();

        return $movie;
    }

    public function update($id, $name, $synopsis, $thumbnailUrl) : Movie
    {
        $movie = $this->find($id);

        $movie->name = $name;
        $movie->synopsis = $synopsis;
        $movie->thumbnail_url = $thumbnailUrl;
        $movie->save();

        return $movie;
    }

    public function destroy($id) : bool
    {
        $movie = $this->find($id);

        return $movie->delete();
    }

}
