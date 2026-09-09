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
        })
        ->with([
            'animal.farm',
            'treatmentDetails.product'
        ])
        ->latest('start_date')
        ->paginate(15);

        return view('treatments.index', compact('treatments'));
    }

    public function create()
    {
        $animals = Animal::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with('farm')
        ->orderBy('name')
        ->get();

        $products = Product::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with('farm')
        ->orderBy('name')
        ->get();

        return view('treatments.create', compact('animals', 'products'));
    }

    public function store(StoreTreatmentRequest $request)
    {
        $data = $request->validated();

        $animal = Animal::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })->findOrFail($data['animal_id']);

        $data['animal_id'] = $animal->id;

        Treatment::create($data);

        return redirect()
            ->route('treatments.index')
            ->with('success', 'Tratamiento veterinario asignado correctamente.');
    }

    public function show(Treatment $treatment)
    {
        $this->authorizeOwner($treatment);

        $treatment->load([
            'animal.farm',
            'treatmentDetails.product'
        ]);

        return view('treatments.show', compact('treatment'));
    }

    public function edit(Treatment $treatment)
    {
        $this->authorizeOwner($treatment);

        $animals = Animal::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with('farm')
        ->orderBy('name')
        ->get();

        $products = Product::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with('farm')
        ->orderBy('name')
        ->get();

        return view('treatments.edit', compact(
            'treatment',
            'animals',
            'products'
        ));
    }

    public function update(
        UpdateTreatmentRequest $request,
        Treatment $treatment
    ) {
        $this->authorizeOwner($treatment);

        $data = $request->validated();

        if (isset($data['animal_id'])) {
            Animal::whereHas('farm', function ($q) {
                $q->where('user_id', auth()->id());
            })->findOrFail($data['animal_id']);
        }

        $treatment->update($data);

        return redirect()
            ->route('treatments.index')
            ->with('success', 'Tratamiento actualizado correctamente.');
    }

    public function destroy(Treatment $treatment)
    {
        $this->authorizeOwner($treatment);

        $treatment->delete();

        return redirect()
            ->route('treatments.index')
            ->with('success', 'Tratamiento eliminado correctamente.');
    }

    private function authorizeOwner(Treatment $treatment): void
    {
        if (
            !$treatment->animal ||
            !$treatment->animal->farm ||
            $treatment->animal->farm->user_id !== auth()->id()
        ) {
            abort(403, 'No tienes permiso para acceder a este tratamiento.');
        }
    }
}