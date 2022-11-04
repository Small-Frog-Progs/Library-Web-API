<?php

namespace App\Http\Controllers;

use App\Http\Requests\JournalStoreRequest;
use App\Http\Requests\JournalUpdateRequest;
use App\Http\Resources\JournalResource;
use App\Models\Journal;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(
            JournalResource::collection(Journal::all()),
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(JournalStoreRequest $request)
    {
        $valid = $request->validated();
        $journal = Journal::create([
            'user_id'   =>  $valid['user_id'],
            'book_id'   =>  $valid['book_id'],
            'start_date'   =>  Carbon::create($valid['start_date']),
            'end_date'   =>  Carbon::create($valid['end_date']),
        ]);
        return response()->json(
            new JournalResource($journal),
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
        $journal = Journal::find($id);
        if ($journal) {
            return response()->json(
                new JournalResource($journal),
            200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JournalUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(JournalUpdateRequest $request, $id)
    {
        $valid = $request->validated();
        $journal = Journal::find($id);
        if ($journal) {
            $journal->update($valid);
            $journal->save();
            return response()->json(
                new JournalResource($journal),
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
        $journal = Journal::find($id);
        if ($journal) {
            Journal::destroy($id);
            return response()->json('success',200);
        }
    }
}
