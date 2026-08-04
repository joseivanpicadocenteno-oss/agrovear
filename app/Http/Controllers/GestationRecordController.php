<?php

namespace App\Http\Controllers;

use App\Models\GestationRecord;
use App\Http\Requests\StoreGestationRecordRequest;
use App\Http\Requests\UpdateGestationRecordRequest;

class GestationRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(GestationRecord::all());
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
    public function store(StoreGestationRecordRequest $request)
    {
        $gestationRecord = GestationRecord::create($request->validated());

        return response()->json([
            'message' => 'Registro de Gestacion creado correctamente.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GestationRecord $gestationRecord)
    {
        return response()->json($gestationRecord);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GestationRecord $gestationRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGestationRecordRequest $request, GestationRecord $gestationRecord)
    {
        $gestationRecord->update($request->validated());

        return response()->json([
            'message' => 'El Record de Gestacion se actualizo correctamente.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GestationRecord $gestationRecord)
    {
        $gestationRecord->delete();

        return response()->json([
            'message' => 'Record de Gestacion eliminado correctamente.'
        ]);
    }
}
