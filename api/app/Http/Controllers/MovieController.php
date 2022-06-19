<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Services\MovieService;

use Illuminate\Database\RecordsNotFoundException;

class MovieController extends Controller
{
    private $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        return MovieResource::collection($this->movieService->getAll());
    }

    public function store(MovieRequest $request)
    {
        try {

            $movieData = $request->only('name', 'synopsis', 'thumbnail_url');

            $movie = $this->movieService->store(
                $movieData['name'],
                $movieData['synopsis'],
                $movieData['thumbnail_url']
            );

            return response()->json($movie, 201);

        } catch (\Exception $exception) {
            return response()->json("Houve um erro interno", 500);
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
                $id,
                $movieData['name'],
                $movieData['synopsis'],
                $movieData['thumbnail_url']
            );

            return response()->json($movie);

        } catch (RecordsNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        } catch (\Exception $exception) {
            return response()->json("Houve um erro interno", 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->movieService->destroy($id);
        } catch (RecordsNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage()], 401);
        } catch (\Exception $exception) {
            return response()->json("Houve um erro interno", 500);
        }
    }
}
