<?php

namespace App\Http\Controllers;

use App\Models\FeedingRecord;
use App\Http\Requests\StoreFeedingRecordRequest;
use App\Http\Requests\UpdateFeedingRecordRequest;

class FeedingRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(FeedingRecord::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedingRecordRequest $request)
    {
        $feedingRecord = FeedingRecord::create($request->validated());

        return response()->json([
            'message' => 'Historial Alimenticio creado correctamente',
            'data' => $feedingRecord
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FeedingRecord $feedingRecord)
    {
        return response()->json($feedingRecord);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeedingRecord $feedingRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedingRecordRequest $request, FeedingRecord $feedingRecord)
    {
        $feedingRecord->update($request->validated());

        return response()->json([
            'message' => 'Historial Alimenticio actualizado correctamente.',
            'data' => $feedingRecord
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedingRecord $feedingrecord)
    {
        $feedingrecord->delete();

        return response()->json([
            'message' => 'Historial Alimenticio eliminado correctamente.'
        ]);
    }
}
