<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Http\Requests\StoreTreatmentRequest;

use Illuminate\Http\Requests;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Treatment::all());
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
    public function store(StoreTreatmentRequest $request)
    {
        $treatment = Treatment::create($request->validated());

        return response()->json([
            'message' => 'Tratamiento creato correctamente.',
            'data' => $treatment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment)
    {
        return response()->json($treatment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTreatmentRequest $request, Treatment $treatment)
    {
        $treatment->update($request->validated());

        return response()->json([
            'message' => 'Tratamiento actualizado correctamente.',
            'data' => $treatment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return response()->json([
            'message' => 'Tratamiento eliminado correctamente.'
        ]);
    }
}
