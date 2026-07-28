<?php

namespace App\Http\Controllers;

use App\Models\TreatmentDetail;
use App\Http\Requests\StoreTreatmentDetailRequest;

class TreatmentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(TreatmentDetail::all());
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
    public function store(StoreTreatmentDetailRequest $request)
    {
        $treatmentDetail = TreatmentDetail::create($request->validation());

        return response()->json([
            'message' => 'Detalles de tratamiento creado correctamente.',
            'data' => $treatmentDetail
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TreatmentDetail $treatmentDetail)
    {
        return response()->json($treatmentDetail);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TreatmentDetail $treatmentDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTreatmentDetailRequest $request, TreatmentDetail $treatmentDetail)
    {
        $treatmentDetail->update($request->validated());

        return response()->json([
            'message' => 'Detalles de tratamiento actualizado correctamente.',
            'data' => $treatmentDetail
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TreatmentDetail $treatmentDetail)
    {
        $treatmentDetail->Delete();

        return response()->json([
            'message' => 'Detalles de tratamiento eliminado correctamente.'
        ]);
    }
}
