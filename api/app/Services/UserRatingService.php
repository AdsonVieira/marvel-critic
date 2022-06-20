<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserRating;

class UserRatingService
{

    private $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function rate(User $user, Int $evaluationGrade, Int $movieId) : bool
    {
        $movie = $this->movieService->find($movieId);

        $userRating = UserRating::where('user_id', $user->id)->where('movie_id', $movieId)->first();
        if (!$userRating) {
            $userRating = new UserRating();
            $userRating->movie_id = $movie->id;
            $userRating->user_id = $user->id;
        }

        $userRating->evaluation_grade = $evaluationGrade;

        return $userRating->save();
    }

}
