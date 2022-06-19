<?php

namespace App\Http\Controllers;

use App\Services\UserRatingService;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Http\Request;

class UserRatingController extends Controller
{
    private $userRatingService;

    public function __construct(UserRatingService $ratingService)
    {
        $this->userRatingService = $ratingService;
    }

    protected function rate(Request $request)
    {
        try {
            $rateData = $request->only('movieId', 'evaluationGrade');
            $this->userRatingService->rate($request->user(), $rateData['evaluationGrade'], $rateData['movieId']);
        } catch (RecordsNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        } catch (\Exception $exception) {
            dd($exception);
            return response()->json("Houve um erro interno", 500);
        }
    }
}
