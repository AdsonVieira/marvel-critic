<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Services\MovieService;

use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class MovieController extends Controller
{
    private $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        return MovieResource::collection($this->movieService->getAll($user->id));
    }

    public function store(MovieRequest $request)
    {
        try {

            $movieData = $request->only('name', 'synopsis', 'thumbnail_url');

            $movie = $this->movieService->store(
                $request->user(),
                $movieData['name'],
                $movieData['synopsis'],
                $movieData['thumbnail_url']
            );

            return response()->json($movie, 201);

        } catch (UnauthorizedException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        } catch (\Exception $exception) {
            return response()->json(['error' => "Houve um erro interno"], 500);
        }
    }

    public function show($id)
    {
        return response()->json($this->movieService->find($id));
    }

    public function update(MovieRequest $request, $id)
    {
        try {

            $movieData = $request->only('name', 'synopsis', 'thumbnail_url');

            $movie = $this->movieService->update(
                $request->user(),
                $id,
                $movieData['name'],
                $movieData['synopsis'],
                $movieData['thumbnail_url']
            );

            return response()->json($movie);

        } catch (UnauthorizedException|RecordsNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        } catch (\Exception $exception) {
            return response()->json(['error' => "Houve um erro interno"], 500);
        }
    }

    public function destroy($id, Request $request)
    {
        try {
            $this->movieService->destroy($request->user(), $id);
        } catch (UnauthorizedException|RecordsNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        } catch (\Exception $exception) {
            return response()->json(['error' => "Houve um erro interno"], 500);
        }
    }
}
