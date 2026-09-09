<?php

namespace App\Http\Controllers;

use App\Models\GestationRecord;
use App\Models\Animal;
use App\Http\Requests\StoreGestationRecordRequest;
use App\Http\Requests\UpdateGestationRecordRequest;

class GestationRecordController extends Controller
{
    public function index()
    {
        $gestations = GestationRecord::whereHas('animal.farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->with('animal.farm')
        ->latest('service_date')
        ->paginate(15);

        return view('gestations.index', compact('gestations'));
    }

    public function create()
    {
        $animals = Animal::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->where('sex', 'Hembra')
        ->with('farm')
        ->orderBy('name')
        ->get();

        return view('gestations.create', compact('animals'));
    }

    public function store(StoreGestationRecordRequest $request)
    {
        $data = $request->validated();

        $animal = Animal::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->where('sex', 'Hembra')
        ->findOrFail($data['animal_id']);

        $data['animal_id'] = $animal->id;

        GestationRecord::create($data);

        return redirect()
            ->route('gestations.index')
            ->with('success', 'Registro de gestación guardado correctamente.');
    }

    public function show(GestationRecord $gestation)
    {
        $this->authorizeOwner($gestation);

        $gestation->load([
            'animal.farm',
            'feedingRecords.recipe',
        ]);

        return view('gestations.show', compact('gestation'));
    }

    public function edit(GestationRecord $gestation)
    {
        $this->authorizeOwner($gestation);

        $animals = Animal::whereHas('farm', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->where('sex', 'Hembra')
        ->with('farm')
        ->orderBy('name')
        ->get();

        return view('gestations.edit', compact('gestation', 'animals'));
    }

    public function update(
        UpdateGestationRecordRequest $request,
        GestationRecord $gestation
    ) {
        $this->authorizeOwner($gestation);

        $data = $request->validated();

        if (isset($data['animal_id'])) {
            Animal::whereHas('farm', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->where('sex', 'Hembra')
            ->findOrFail($data['animal_id']);
        }

        $gestation->update($data);

        return redirect()
            ->route('gestations.index')
            ->with('success', 'Registro de gestación actualizado correctamente.');
    }

    public function destroy(GestationRecord $gestation)
    {
        $this->authorizeOwner($gestation);

        $gestation->delete();

        return redirect()
            ->route('gestations.index')
            ->with('success', 'Registro de gestación eliminado correctamente.');
    }

    private function authorizeOwner(GestationRecord $gestation): void
    {
        if (
            !$gestation->animal ||
            !$gestation->animal->farm ||
            $gestation->animal->farm->user_id !== auth()->id()
        ) {
            abort(403, 'No tienes permiso para acceder a este registro.');
        }
    }
}