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
                'message' => 'Este proyecto ya forma parte de la receta.'
            ], 402);
        }

        $recipeDetail = RecipeDetail::create($request->validated());

        return response()->json([
            'message' => 'Detalles de Receta creado correctamente',
            'data' => $recipeDetail
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(RecipeDetail $recipeDetail)
    {
        return response()->json($recipeDetail);
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
        $recipeDetail->update($request->validated());

        return response()->json([
            'message' => 'Detalles de Receta actualizado correctamente.',
            'data' => $recipeDetail
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RecipeDetail $recipeDetail)
    {
        $recipeDetail->delete();

        return response()->json([
            'message' => 'Detalles de receta eliminados correctamente.'
        ]);
    }
}
