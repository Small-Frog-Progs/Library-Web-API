<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreStoreRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(
            GenreResource::collection(Genre::all()),
        200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GenreStoreRequest $request
     * @return JsonResponse
     */
    public function store(GenreStoreRequest $request)
    {
        $valid = $request->validated();
        $genre = Genre::create($valid);
        return response()->json(
            new GenreResource($genre),
        200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $genre = Genre::find($id);
        if ($genre) {
            return response()->json(
                new GenreResource($genre),
            200);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param GenreUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(GenreUpdateRequest $request, $id)
    {
        $valid = $request->validated();
        $genre = Genre::findOrFail($id);
        $genre->update($valid);
        return response()->json(
            new GenreResource($genre),
        200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $genre = Genre::find($id);
        if ($genre) {
            Genre::destroy($id);
            return response()->json('success',200);
        }
    }
}
