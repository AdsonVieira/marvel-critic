<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function metrics()
    {
        $SQL = "SELECT
                    SUM(evaluation_grade) AS ranking, movie_id, movies.name, movies.thumbnail_url
                FROM
                    user_rating inner join movies on movies.id = movie_id
                GROUP BY movie_id
                ORDER BY ranking DESC limit 3";

        return $dataRanking = DB::select($SQL);
    }
}
