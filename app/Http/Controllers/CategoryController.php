<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(
            CategoryResource::collection(Category::all()),
        200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return JsonResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        $valid = $request->validated();
        $category = Category::create($valid);
        return response()->json(
            new CategoryResource($category),
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
        $category = Category::find($id);
        if ($category) {
            return response()->json(
                new CategoryResource($category),
            200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $valid = $request->validated();
        $category = Category::find($id);
        if ($category) {
            $category->update($valid);
            $category->save();
            return response()->json(
                new CategoryResource($category),
            200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            Category::destroy($id);
            return response()->json('success',200);
        }
    }
}
