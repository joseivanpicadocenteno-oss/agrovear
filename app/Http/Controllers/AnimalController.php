<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Animal::with('farm:id,name')
                ->whereHas('farm', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->orderBy('name')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalRequest $request)
    {
        $farm = auth()->user()->farms()->find($request->farm_id);

        if (!$farm) {
            return response()->json([
                'message' => 'No tienes permiso para agregar animales a esta granja.'
            ], 403);
        }

        $animal = Animal::create($request->validated());

        return response()->json([
            'message' => 'Animal creado correctamente',
            'data' => $animal->load('farm:id,name')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        $animal->load([
            'farm:id,name,user_id',
            'treatments:id,animal_id,start_date,end_date,status',
            'feedingRecords:id,animal_id,feeding_date',
            'gestationRecords:id,animal_id,service_date'
        ]);

        if ($animal->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para acceder a este animal.'
            ], 403);
        }

        return response()->json($animal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        $animal->load('farm:id,user_id');

        if ($animal->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para modificar este animal.'
            ], 403);
        }

        if ($request->filled('farm_id')) {

            $farm = auth()->user()->farms()->find($request->farm_id);

            if (!$farm) {
                return response()->json([
                    'message' => 'No puedes mover el animal a una granja que no te pertenece.'
                ], 403);
            }
        }

        $animal->update($request->validated());

        return response()->json([
            'message' => 'Animal actualizado correctamente',
            'data' => $animal->load('farm:id,name')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        $animal->load('farm:id,user_id');
    
        if ($animal->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para eliminar este animal.'
            ], 403);
        }

        $animal->delete();

        return response()->json([
            'message' => 'Animal eliminado correctamente'
        ]);
    }
}