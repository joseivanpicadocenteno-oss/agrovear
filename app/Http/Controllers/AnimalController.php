<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Http\Requests\StoreAnimalRequest;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Animal::all());
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
    public function store(StoreAnimalRequest $request)
    {
        $animal = Animal::create($request->validated());

        return response()->json([
            'message' => 'Animal creado correctamente',
            'data' => $animal
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        return response()->json($animal);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAnimalRequest $request, Animal $animal)
    {
        $animal->update($request->validated());

        return response()->json([
            'message' => 'Animal actualizado correctamente',
            'data' => $animal
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();

        return response()->json([
            'message' => 'Animal eliminado correctamente'
        ]);
    }
}
