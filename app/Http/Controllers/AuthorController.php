<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
//        return response()->json([
//            'response'  =>  [
//                'message'   =>  'success',
//                'data'   =>  Author::all(),
//            ],
//        ]);
        return response()->json(
            AuthorResource::collection(Author::all())
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorStoreRequest $request
     * @return JsonResponse
     */
    public function store(AuthorStoreRequest $request)
    {
        $valid = $request->validated();
        $author = Author::create($valid);
//        return response()->json([
//            'response'  =>  [
//                'message'   =>  'success',
//                'data'  =>  $author,
//            ],
//        ],200);
        return response()->json($author,200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
//        return response()->json([
//            'response'  =>  [
//                'message'   =>  'success',
//                'data'    =>  Author::find($id),
//            ],
//        ],200);
        $author = Author::findOrFail($id);
//        if ($author) {
            return response()->json(new AuthorResource($author),200);
//        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(AuthorUpdateRequest $request, int $id)
    {
        $valid = $request->validated();
        $author = Author::findOrFail($id);
        $author->update($valid);
        $author->save();
//        return response()->json([
//            'response'  =>  [
//                'message'   =>  'success',
//                'data'    =>  $author,
//            ],
//        ],200);
        return response()->json($author,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        Author::destroy($id);
//        return response()->json([
//            'response'  =>  [
//                'message'   =>  'success',
//            ],
//        ],200);
        return response()->json('success',200);
    }
}
