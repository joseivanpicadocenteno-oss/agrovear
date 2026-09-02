<?php

namespace App\Http\Controllers;

use App\Models\RecipeDetail;
use App\Http\Requests\StoreRecipeDetailRequest;
use App\Http\Requests\UpdateRecipeDetailRequest;


class RecipeDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            RecipeDetail::with([
            'recipe:id,name',
            'product:id,name'
        ])

        ->whereHas('recipe.farm', function ($query) {
            $query->where('user_id', auth()->id());
        })

        ->orderBy('recipe_id')
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
    public function store(StoreRecipeDetailRequest $request)
    {
        $exists = RecipeDetail::where('recipe_id', $request->recipe_id)
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {

            return response()->json([
                'message' => 'Este producto ya forma parte de la receta.'
            ], 402);
        }

        $recipeDetail = RecipeDetail::create($request->validated());

        return response()->json([
            'message' => 'Ingrediente creado correctamente',
            'data' => $recipeDetail->load
            ('recipe_id:name, product_id:name')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(RecipeDetail $recipeDetail)
    {

        $recipeDetail->load(['recipe:id,name', 'product:id_name']);

        if  ($recipeDetail->recipe->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para acceder a este ingrediente.'
            ], 403);
        }

        return response()->json(
            $recipeDetail->load([
                'recipe:id,name',
                'product:id,name'
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RecipeDetail $recipeDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeDetailRequest $request, RecipeDetail $recipeDetail)
    {
        $recipeDetail->load(['recipe:id,name', 'product:id_name']);

        if  ($recipeDetail->recipe->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para actualizar a este ingrediente.'
            ], 402);
        }

        $exists = RecipeDetail::where('recipe_id',$request->recipe_id)
            ->where('product_id',$request->product_id)
            ->exists();

        if ($exists) {

            return response()->json([
                'message'=>'Este producto ya forma parte de la receta.'
            ],422);

        }

        $recipeDetail->update($request->validated());

        return response()->json([
            'message' => 'Detalles de Receta actualizado correctamente.',
            'data' => $recipeDetail->load('farm:id,name')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RecipeDetail $recipeDetail)
    {
        if ($recipeDetail->recipe->farm->user_id !== auth()->id()) {

        return response()->json([
            'message'=>'No tienes permiso para eliminar este ingrediente.'
        ],403);

        }

        $recipeDetail->delete();

        return response()->json([
            'message' => 'Detalles de receta eliminados correctamente.'
        ]);
    }
}
