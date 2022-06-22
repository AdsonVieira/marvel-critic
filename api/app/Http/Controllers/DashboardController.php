<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class DashboardController extends Controller
{
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    protected function metrics()
    {
        try {
            return response()->json($this->dashboardService->metrics(), 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => "Houve um erro interno"], 500);
        }
    }
}
