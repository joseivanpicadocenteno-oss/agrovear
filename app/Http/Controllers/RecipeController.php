<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Farm;
use App\Models\Product;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })->with(['farm', 'recipeDetails.product'])->latest()->paginate(15);

        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        $farms = Farm::where('user_id', auth()->id())->where('active', true)->get();
        $products = Product::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))->get();

        return view('recipes.create', compact('farms', 'products'));
    }

    public function store(StoreRecipeRequest $request)
    {
        $recipe = Recipe::create($request->validated());

        return redirect()->route('recipes.index')->with('success', 'Receta/Dieta creada correctamente.');
    }

    public function show(Recipe $recipe)
    {
        $this->authorizeOwner($recipe);
        $recipe->load(['farm', 'recipeDetails.product']);

        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $this->authorizeOwner($recipe);
        $farms = Farm::where('user_id', auth()->id())->where('active', true)->get();
        $products = Product::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))->get();

        return view('recipes.edit', compact('recipe', 'farms', 'products'));
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $this->authorizeOwner($recipe);
        $recipe->update($request->validated());

        return redirect()->route('recipes.index')->with('success', 'Receta actualizada.');
    }

    public function destroy(Recipe $recipe)
    {
        $this->authorizeOwner($recipe);
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Receta eliminada.');
    }

    private function authorizeOwner(Recipe $recipe)
    {
        if ($recipe->farm->user_id !== auth()->id()) {
            abort(403, 'No autorizado.');
        }
    }
}