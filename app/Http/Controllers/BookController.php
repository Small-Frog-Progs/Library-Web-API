<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json([
            'response'  =>  [
                'message'   =>  'success',
                'data'  =>  Book::all(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(BookStoreRequest $request)
    {
        $valid = $request->validated();
        $book = Book::create([
            'name'  =>  $valid['name'],
            'category_id'  =>  $valid['category_id'],
            'image_path'  =>  $valid['image_path'],
            'shelf_id'  =>  $valid['shelf_id'],
            'is_digit'  =>  $valid['is_digit'],
            'book_path'  =>  $valid['name'],
        ]);
        $book->genres()->attach($valid['genres']);
        $book->authors()->attach($valid['authors']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $book = BookResource(Book::find($id));
        return response()->json([
            'response'  =>  [
                'message'   =>  'success',
                'data'  =>  Book::find($id),
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
