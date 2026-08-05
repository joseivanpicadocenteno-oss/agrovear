<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    /**
     * Mostrar todas las recetas del usuario autenticado.
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
     * Crear una nueva receta.
     */
    public function store(StoreRecipeRequest $request)
    {
        $farm = auth()->user()->farms()->find($request->farm_id);

        if (!$farm) {
            return response()->json([
                'message' => 'No tienes permiso para agregar recetas a esta granja.'
            ], 403);
        }

        $recipe = Recipe::create($request->validated());

        return response()->json([
            'message' => 'Receta creada correctamente.',
            'data' => $recipe->load('farm:id,name')
        ], 201);
    }

    /**
     * Mostrar una receta.
     */
    public function show(Recipe $recipe)
    {
        $recipe->load([
            'farm:id,name,user_id',

            // Productos que componen la receta
            'recipeDetails:id,recipe_id,product_id,quantity',
            'recipeDetails.product:id,name,unit_measurement'
        ]);

        if ($recipe->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para acceder a esta receta.'
            ], 403);
        }

        // Ocultamos el user_id antes de responder
        unset($recipe->farm->user_id);

        return response()->json($recipe);
    }

    /**
     * Actualizar una receta.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $recipe->load('farm:id,user_id');

        if ($recipe->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para modificar esta receta.'
            ], 403);
        }

        if ($request->filled('farm_id')) {

            $farm = auth()->user()->farms()->find($request->farm_id);

            if (!$farm) {
                return response()->json([
                    'message' => 'No puedes mover la receta a una granja que no te pertenece.'
                ], 403);
            }
        }

        $recipe->update($request->validated());

        return response()->json([
            'message' => 'Receta actualizada correctamente.',
            'data' => $recipe->load('farm:id,name')
        ]);
    }

    /**
     * Eliminar una receta.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->load('farm:id,user_id');

        if ($recipe->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para eliminar esta receta.'
            ], 403);
        }

        $recipe->delete();

        return response()->json([
            'message' => 'Receta eliminada correctamente.'
        ]);
    }
}