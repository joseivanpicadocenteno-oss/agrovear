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
        return response()->json(
            Farm::where('user_id', auth()->id())->get()
        );
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
        $farm = Farm::create([
            ...$request->validated(),
            'user_id' => auth()->id()
        ]);

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
        if ($farm->user_id !== auth()->id()) {
        return response()->json([
                'message' => 'No tienes permiso para acceder a esta granja.'
            ],403);
        }

        return response()->json(
            $farm->load([
            'animals:id,name,species,farm_id',
            'products:id,name,current_stock,farm_id',
            'recipes:id,name,farm_id'
        ]));
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
    public function update(UpdateFarmRequest $request, Farm $farm)
    {
        if ($farm->user_id !== auth()->id()) 
        {
            return response()->json([
                'message' => 'No tienes permiso para modificar esta granja.'
            ],403);
        }


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
        if ($farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para eliminar esta granja.'
            ],403);
        }


        $farm->delete();

        return response()->json([
            'message' => 'La Granja se ha eliminado correctamente'
        ]);
    }
}
