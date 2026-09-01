<?php

namespace App\Http\Controllers;

use App\Models\FeedingRecord;
use App\Models\Animal;
use App\Models\Recipe;
use App\Http\Requests\StoreFeedingRecordRequest;

class FeedingRecordController extends Controller
{
    public function index()
    {
        $feedings = FeedingRecord::whereHas('animal.farm', function ($q) {
            $q->where('user_id', auth()->id());
        })->with(['animal', 'recipe'])->latest()->paginate(15);

        return view('feedings.index', compact('feedings'));
    }

    public function create()
    {
        $animals = Animal::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))->get();
        $recipes = Recipe::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))->get();

        return view('feedings.create', compact('animals', 'recipes'));
    }

    public function store(StoreFeedingRecordRequest $request)
    {
        FeedingRecord::create($request->validated());

        return redirect()->route('feedings.index')->with('success', 'Registro de alimentación guardado.');
    }

    public function destroy(FeedingRecord $feeding)
    {
        if ($feeding->animal->farm->user_id !== auth()->id()) {
            abort(403);
        }

        $feeding->delete();

        return redirect()->route('feedings.index')->with('success', 'Registro de alimentación eliminado.');
    }
}
