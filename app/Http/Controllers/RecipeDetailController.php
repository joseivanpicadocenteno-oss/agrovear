<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeDetail;
use App\Models\Product;
use App\Http\Requests\StoreRecipeDetailRequest;
use App\Http\Requests\UpdateRecipeDetailRequest;
use Illuminate\Http\Request;

class RecipeDetailController extends Controller
{
    /**
     * Mostrar todos los ingredientes de las recetas del usuario.
     */
    public function index()
    {
        $recipeDetails = RecipeDetail::with([
            'recipe:id,name,farm_id',
            'recipe.farm:id,name,user_id',
            'product:id,name,unit_measurement'
        ])
        ->whereHas('recipe.farm', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->latest()
        ->paginate(15);

        return view('recipe-details.index', compact('recipeDetails'));
    }


    /**
     * Mostrar formulario para crear un ingrediente.
     */
    public function create()
    {
        $recipes = Recipe::whereHas('farm', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->with('farm:id,name')
        ->latest()
        ->get();

        $products = Product::whereHas('farm', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->orderBy('name')
        ->get();

        return view('recipe-details.create', compact(
            'recipes',
            'products'
        ));
    }


    /**
     * Guardar un ingrediente.
     */
    public function store(StoreRecipeDetailRequest $request)
    {
        $validated = $request->validated();

        /*
         * Verificar que la receta pertenezca al usuario.
         */
        $recipe = Recipe::where('id', $validated['recipe_id'])
            ->whereHas('farm', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->first();

        if (!$recipe) {
            abort(403, 'No tienes permiso para agregar ingredientes a esta receta.');
        }


        /*
         * Verificar que el producto pertenezca al usuario.
         */
        $product = Product::where('id', $validated['product_id'])
            ->whereHas('farm', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->first();

        if (!$product) {
            abort(403, 'No tienes permiso para utilizar este producto.');
        }


        /*
         * Evitar productos duplicados dentro de la misma receta.
         */
        $exists = RecipeDetail::where('recipe_id', $recipe->id)
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Este producto ya forma parte de la receta.');
        }


        RecipeDetail::create([
            'recipe_id' => $recipe->id,
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'instruction' => $validated['instruction'],
        ]);


        return redirect()
            ->route('recipe-details.index')
            ->with('success', 'Ingrediente agregado correctamente.');
    }


    /**
     * Mostrar un ingrediente.
     */
    public function show(RecipeDetail $recipeDetail)
    {
        $this->authorizeOwner($recipeDetail);

        $recipeDetail->load([
            'recipe:id,name,farm_id',
            'recipe.farm:id,name,user_id',
            'product:id,name,unit_measurement'
        ]);

        return view('recipe-details.show', compact('recipeDetail'));
    }


    /**
     * Mostrar formulario para editar un ingrediente.
     */
    public function edit(RecipeDetail $recipeDetail)
    {
        $this->authorizeOwner($recipeDetail);

        $recipeDetail->load([
            'recipe:id,name,farm_id',
            'product:id,name,unit_measurement'
        ]);


        $recipes = Recipe::whereHas('farm', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->with('farm:id,name')
        ->latest()
        ->get();


        $products = Product::whereHas('farm', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->orderBy('name')
        ->get();


        return view('recipe-details.edit', compact(
            'recipeDetail',
            'recipes',
            'products'
        ));
    }


    /**
     * Actualizar un ingrediente.
     */
    public function update(
        UpdateRecipeDetailRequest $request,
        RecipeDetail $recipeDetail
    ) {
        $this->authorizeOwner($recipeDetail);

        $validated = $request->validated();


        /*
         * Obtener receta actual o nueva.
         */
        $recipeId = $validated['recipe_id'] ?? $recipeDetail->recipe_id;

        $recipe = Recipe::where('id', $recipeId)
            ->whereHas('farm', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->first();

        if (!$recipe) {
            abort(403, 'No tienes permiso para utilizar esta receta.');
        }


        /*
         * Obtener producto actual o nuevo.
         */
        $productId = $validated['product_id'] ?? $recipeDetail->product_id;

        $product = Product::where('id', $productId)
            ->whereHas('farm', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->first();

        if (!$product) {
            abort(403, 'No tienes permiso para utilizar este producto.');
        }


        /*
         * Evitar duplicados, excluyendo el propio detalle.
         */
        $exists = RecipeDetail::where('recipe_id', $recipe->id)
            ->where('product_id', $product->id)
            ->where('id', '!=', $recipeDetail->id)
            ->exists();


        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Este producto ya forma parte de la receta.');
        }


        $recipeDetail->update([
            'recipe_id' => $recipe->id,
            'product_id' => $product->id,
            'quantity' => $validated['quantity'] ?? $recipeDetail->quantity,
            'instruction' => $validated['instruction'] ?? $recipeDetail->instruction,
        ]);


        return redirect()
            ->route('recipe-details.show', $recipeDetail)
            ->with('success', 'Ingrediente actualizado correctamente.');
    }


    /**
     * Eliminar un ingrediente.
     */
    public function destroy(RecipeDetail $recipeDetail)
    {
        $this->authorizeOwner($recipeDetail);

        $recipeDetail->delete();

        return redirect()
            ->route('recipe-details.index')
            ->with('success', 'Ingrediente eliminado correctamente.');
    }


    /**
     * Verificar propiedad del ingrediente.
     */
    private function authorizeOwner(RecipeDetail $recipeDetail): void
    {
        $recipeDetail->loadMissing('recipe.farm');

        if (
            !$recipeDetail->recipe ||
            !$recipeDetail->recipe->farm ||
            $recipeDetail->recipe->farm->user_id !== auth()->id()
        ) {
            abort(403, 'No autorizado.');
        }
    }
}
