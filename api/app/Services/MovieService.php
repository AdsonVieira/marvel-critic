<?php

namespace App\Services;

use App\Models\Movie;

use App\Models\User;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

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
        return Movie::with('userRating')->paginate(10);
    }

    public function store(User $user, String $name, String $synopsis, String $thumbnailUrl) : Movie
    {
        $this->onlyUserAdminCanExecAction($user);

        $movie = new Movie();
        $movie->name = $name;
        $movie->synopsis = $synopsis;
        $movie->thumbnail_url = $thumbnailUrl;
        $movie->save();

        return $movie;
    }

    public function update(User $user, Int $id, String $name, String $synopsis, String $thumbnailUrl) : Movie
    {
        $this->onlyUserAdminCanExecAction($user);

        $movie = $this->find($id);

        $movie->name = $name;
        $movie->synopsis = $synopsis;
        $movie->thumbnail_url = $thumbnailUrl;
        $movie->save();

        return $movie;
    }

    public function destroy(User $user, Int $id) : bool
    {
        $this->onlyUserAdminCanExecAction($user);

        $movie = $this->find($id);

        return $movie->delete();
    }

    private function onlyUserAdminCanExecAction(User $user)
    {
        if (!$user->is_admin) {
            throw new UnauthorizedException('O usuário precisa ser admin.');
        }
    }

}
