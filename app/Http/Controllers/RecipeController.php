<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Farm;
use App\Models\Product;
use App\Models\RecipeDetail;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with(['farm', 'recipeDetails.product'])
        ->latest()
        ->paginate(15);

        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        $farms = Farm::where('user_id', auth()->id())
            ->where('active', true)
            ->get();

        $products = Product::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->get();

        return view('recipes.create', compact('farms', 'products'));
    }

    public function store(StoreRecipeRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($request, $validated) {

            /*
             * Verificamos que la finca pertenezca al usuario.
             */
            $farm = Farm::where('id', $validated['farm_id'])
                ->where('user_id', auth()->id())
                ->first();

            if (!$farm) {
                abort(403, 'No tienes permiso para utilizar esta finca.');
            }

            /*
             * Creamos la receta principal.
             */
            $recipe = Recipe::create($validated);

            /*
             * Guardamos los ingredientes enviados desde el formulario.
             */
            $details = $request->input('details', []);

            $usedProducts = [];

            foreach ($details as $detail) {

                /*
                 * Ignorar filas completamente vacías.
                 */
                if (
                    empty($detail['product_id']) &&
                    empty($detail['quantity']) &&
                    empty($detail['instruction'])
                ) {
                    continue;
                }

                /*
                 * Validación adicional del detalle.
                 */
                if (
                    empty($detail['product_id']) ||
                    !isset($detail['quantity']) ||
                    $detail['quantity'] === '' ||
                    empty(trim($detail['instruction'] ?? ''))
                ) {
                    abort(422, 'Todos los ingredientes deben tener producto, cantidad e instrucción.');
                }

                /*
                 * Evitar productos repetidos dentro de la misma receta.
                 */
                if (in_array((int) $detail['product_id'], $usedProducts, true)) {
                    abort(422, 'No puedes agregar el mismo producto más de una vez en una receta.');
                }

                $usedProducts[] = (int) $detail['product_id'];

                /*
                 * El producto debe pertenecer a una finca del usuario.
                 */
                $product = Product::where('id', $detail['product_id'])
                    ->whereHas('farm', function ($q) {
                        $q->where('user_id', auth()->id());
                    })
                    ->first();

                if (!$product) {
                    abort(403, 'Uno de los productos seleccionados no te pertenece.');
                }

                RecipeDetail::create([
                    'recipe_id' => $recipe->id,
                    'product_id' => $product->id,
                    'quantity' => $detail['quantity'],
                    'instruction' => trim($detail['instruction']),
                ]);
            }
        });

        return redirect()
            ->route('recipes.index')
            ->with('success', 'Receta/Dieta creada correctamente.');
    }

    public function show(Recipe $recipe)
    {
        $this->authorizeOwner($recipe);

        $recipe->load([
            'farm',
            'recipeDetails.product'
        ]);

        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $this->authorizeOwner($recipe);

        $recipe->load('recipeDetails.product');

        $farms = Farm::where('user_id', auth()->id())
            ->where('active', true)
            ->get();

        $products = Product::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->get();

        return view('recipes.edit', compact(
            'recipe',
            'farms',
            'products'
        ));
    }

    public function update(
        UpdateRecipeRequest $request,
        Recipe $recipe
    ) {
        $this->authorizeOwner($recipe);

        $validated = $request->validated();

        DB::transaction(function () use ($request, $validated, $recipe) {

            /*
             * Verificamos la finca nueva.
             */
            $farm = Farm::where('id', $validated['farm_id'])
                ->where('user_id', auth()->id())
                ->first();

            if (!$farm) {
                abort(403, 'No tienes permiso para utilizar esta finca.');
            }

            /*
             * Actualizamos la receta.
             */
            $recipe->update($validated);

            /*
             * Ingredientes recibidos desde el formulario.
             */
            $details = $request->input('details', []);

            /*
             * IDs existentes enviados por el formulario.
             * Los que no aparezcan después serán eliminados.
             */
            $receivedIds = [];

            $usedProducts = [];

            foreach ($details as $detail) {

                /*
                 * Ignorar filas vacías.
                 */
                if (
                    empty($detail['product_id']) &&
                    empty($detail['quantity']) &&
                    empty($detail['instruction'])
                ) {
                    continue;
                }

                /*
                 * Validación básica.
                 */
                if (
                    empty($detail['product_id']) ||
                    !isset($detail['quantity']) ||
                    $detail['quantity'] === '' ||
                    empty(trim($detail['instruction'] ?? ''))
                ) {
                    abort(422, 'Todos los ingredientes deben tener producto, cantidad e instrucción.');
                }

                /*
                 * Evitar productos duplicados.
                 */
                if (in_array((int) $detail['product_id'], $usedProducts, true)) {
                    abort(422, 'No puedes agregar el mismo producto más de una vez en una receta.');
                }

                $usedProducts[] = (int) $detail['product_id'];

                /*
                 * El producto debe pertenecer al usuario.
                 */
                $product = Product::where('id', $detail['product_id'])
                    ->whereHas('farm', function ($q) {
                        $q->where('user_id', auth()->id());
                    })
                    ->first();

                if (!$product) {
                    abort(403, 'Uno de los productos seleccionados no te pertenece.');
                }

                /*
                 * Si viene ID, actualizamos.
                 */
                if (!empty($detail['id'])) {

                    $recipeDetail = RecipeDetail::where('id', $detail['id'])
                        ->where('recipe_id', $recipe->id)
                        ->first();

                    if (!$recipeDetail) {
                        abort(404, 'No se encontró uno de los ingredientes de esta receta.');
                    }

                    $recipeDetail->update([
                        'product_id' => $product->id,
                        'quantity' => $detail['quantity'],
                        'instruction' => trim($detail['instruction']),
                    ]);

                    $receivedIds[] = $recipeDetail->id;

                } else {

                    /*
                     * Si no viene ID, significa que es un ingrediente nuevo.
                     */
                    $newDetail = RecipeDetail::create([
                        'recipe_id' => $recipe->id,
                        'product_id' => $product->id,
                        'quantity' => $detail['quantity'],
                        'instruction' => trim($detail['instruction']),
                    ]);

                    $receivedIds[] = $newDetail->id;
                }
            }

            /*
             * Eliminamos los ingredientes que estaban antes
             * pero ya no fueron enviados por el formulario.
             */
        $recipe->recipeDetails()
            ->when(
                count($receivedIds) > 0,
                fn ($query) => $query->whereNotIn('id', $receivedIds)
            )
            ->delete();
        });

        return redirect()
            ->route('recipes.show', $recipe)
            ->with('success', 'Receta e ingredientes actualizados correctamente.');
    }

    public function destroy(Recipe $recipe)
    {
        $this->authorizeOwner($recipe);

        $recipe->delete();

        return redirect()
            ->route('recipes.index')
            ->with('success', 'Receta eliminada.');
    }

    private function authorizeOwner(Recipe $recipe)
    {
        $recipe->loadMissing('farm');

        if (!$recipe->farm || $recipe->farm->user_id !== auth()->id()) {
            abort(403, 'No autorizado.');
        }
    }
}
