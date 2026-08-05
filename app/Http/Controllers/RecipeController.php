<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Recipe::with('farm:id,name')
                ->whereHas('farm', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->orderBy('name')
                ->get()
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
    public function store(StoreRecipeRequest $request)
    {
        $farm = auth()->user()->farms()->find($request->farm_id);

        if (!$farm) {
            return response()->json([
                'message' => 'No tienes permiso para agregar Recetas a esta granja'
            ], 403);
        }

        $recipe = Recipe::create($request->validated());

        return response()->json([
            'message' => 'Receta creada correctamente',
            'data' => $recipe
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe->load([
            'farm:id,name,user_id'
        ]);

        if ($recipe->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para acceder a esta receta.'
            ], 403);
        }
    
        return response()->json($recipe);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $recipe->load('farm:id,user_id');

        if ($recipe->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para modificar esta receta.'
            ], 403);
        }

        if ($recipe->filled('farm_id')) {

            $farm = auth()->user()->farms()->find($request->farm_id);

            if (!$farm) {
                return response()->json([
                    'message' => 'NO puedes mover la recete a una granja que no te pertenece'
                ], 403);
            }
        }

        $recipe->update($request->validated());

        return response()->json([
            'message' => 'Receta actualizada correctamente',
            'data' => $recipe->load('farm:id,name')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->load('farm:id,user_id');

        if ($recipe->farm->user_id != auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para eliminar esta receta.'
            ], 403);
        }
    
        $recipe->delete();

        return response()->json([
        'message' => 'Receta eliminada correctamente',
        ]);
    }
}
