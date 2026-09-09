<?php

namespace App\Http\Controllers;

use App\Models\FeedingRecord;
use App\Models\Animal;
use App\Models\Recipe;
use App\Models\GestationRecord;
use App\Http\Requests\StoreFeedingRecordRequest;
use App\Http\Requests\UpdateFeedingRecordRequest;

class FeedingRecordController extends Controller
{
    public function index()
    {
        $feedings = FeedingRecord::whereHas('animal.farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with([
            'animal',
            'recipe',
            'gestationRecord'
        ])
        ->latest('feeding_date')
        ->paginate(15);

        return view('feedings.index', compact('feedings'));
    }

    public function create()
    {
        $animals = Animal::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with('farm')
        ->orderBy('name')
        ->get();

        $recipes = Recipe::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->orderBy('name')
        ->get();

        $gestationRecords = GestationRecord::whereHas('animal.farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with('animal')
        ->latest()
        ->get();

        return view('feedings.create', compact(
            'animals',
            'recipes',
            'gestationRecords'
        ));
    }

    public function store(StoreFeedingRecordRequest $request)
    {
        $data = $request->validated();

        $animal = Animal::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })->findOrFail($data['animal_id']);

        $recipe = Recipe::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })->findOrFail($data['recipe_id']);

        if (!empty($data['gestation_record_id'])) {
            GestationRecord::whereHas('animal.farm', function ($q) {
                $q->where('user_id', auth()->id());
            })->findOrFail($data['gestation_record_id']);
        }

        $feeding = new FeedingRecord($data);

        $feeding->animal_id = $animal->id;
        $feeding->recipe_id = $recipe->id;
        $feeding->load('recipe.recipeDetails.product');

        $feeding->estimated_feed_cost = $feeding->calculateEstimatedCost();

        $feeding->save();

        return redirect()
            ->route('feedings.index')
            ->with('success', 'Registro de alimentación guardado correctamente.');
    }

    public function show(FeedingRecord $feeding)
    {
        $this->authorizeOwner($feeding);

        $feeding->load([
            'animal.farm',
            'recipe.recipeDetails.product',
            'gestationRecord'
        ]);

        return view('feedings.show', compact('feeding'));
    }

    public function edit(FeedingRecord $feeding)
    {
        $this->authorizeOwner($feeding);

        $animals = Animal::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with('farm')
        ->orderBy('name')
        ->get();

        $recipes = Recipe::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->orderBy('name')
        ->get();

        $gestationRecords = GestationRecord::whereHas('animal.farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with('animal')
        ->latest()
        ->get();

        return view('feedings.edit', compact(
            'feeding',
            'animals',
            'recipes',
            'gestationRecords'
        ));
    }

    public function update(UpdateFeedingRecordRequest $request, FeedingRecord $feeding)
    {
        $this->authorizeOwner($feeding);

        $data = $request->validated();

        if (isset($data['animal_id'])) {
            Animal::whereHas('farm', function ($q) {
                $q->where('user_id', auth()->id());
            })->findOrFail($data['animal_id']);
        }

        if (isset($data['recipe_id'])) {
            Recipe::whereHas('farm', function ($q) {
                $q->where('user_id', auth()->id());
            })->findOrFail($data['recipe_id']);
        }

        if (!empty($data['gestation_record_id'])) {
            GestationRecord::whereHas('animal.farm', function ($q) {
                $q->where('user_id', auth()->id());
            })->findOrFail($data['gestation_record_id']);
        }

        $feeding->update($data);

        $feeding->load('recipe.recipeDetails.product');

        $feeding->estimated_feed_cost = $feeding->calculateEstimatedCost();
        $feeding->save();

        return redirect()
            ->route('feedings.index')
            ->with('success', 'Registro de alimentación actualizado correctamente.');
    }

    public function destroy(FeedingRecord $feeding)
    {
        $this->authorizeOwner($feeding);

        $feeding->delete();

        return redirect()
            ->route('feedings.index')
            ->with('success', 'Registro de alimentación eliminado.');
    }

    private function authorizeOwner(FeedingRecord $feeding): void
    {
        if (
            !$feeding->animal ||
            !$feeding->animal->farm ||
            $feeding->animal->farm->user_id !== auth()->id()
        ) {
            abort(403, 'No tienes permiso para acceder a este registro.');
        }
    }
}