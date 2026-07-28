<?php

namespace App\Http\Controllers;

use App\Models\Farm;

use App\Http\Requests\StoreFarmRequest;
use App\Http\Requests\UpdateFarmRequest;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Farm::all());
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
    public function store(StoreFarmRequest $request)
    {
        $farm = Farm::create($request->validated());

        return response()->json([
            'message' => 'Granja creada correctamente',
            'data' => $farm
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Farm $farm)
    {
        return response()->json($farm);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farm $farm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateFarmRequest $request, Farm $farm)
    {
        $farm->update($request->validated());

        return response()->json([
            'message' => 'Granja actualizada correctamente',
            'data' => $farm
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farm $farm)
    {
        $farm->delete();

        return response()->json([
            'message' => 'La Granja se ha eliminado correctamente'
        ]);
    }
}
