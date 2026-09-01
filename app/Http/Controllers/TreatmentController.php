<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Animal;
use App\Models\Product;
use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::whereHas('animal.farm', function ($q) {
            $q->where('user_id', auth()->id());
        })->with(['animal', 'treatmentDetails.product'])->latest()->paginate(15);

        return view('treatments.index', compact('treatments'));
    }

    public function create()
    {
        $animals = Animal::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))->get();
        $products = Product::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))->get();

        return view('treatments.create', compact('animals', 'products'));
    }

    public function store(StoreTreatmentRequest $request)
    {
        Treatment::create($request->validated());

        return redirect()->route('treatments.index')->with('success', 'Tratamiento veterinario asignado.');
    }

    public function show(Treatment $treatment)
    {
        $this->authorizeOwner($treatment);
        $treatment->load(['animal', 'treatmentDetails.product']);

        return view('treatments.show', compact('treatment'));
    }

    public function destroy(Treatment $treatment)
    {
        $this->authorizeOwner($treatment);
        $treatment->delete();

        return redirect()->route('treatments.index')->with('success', 'Tratamiento eliminado.');
    }

    private function authorizeOwner(Treatment $treatment)
    {
        if ($treatment->animal->farm->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
