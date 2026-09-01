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
        })->with('animal')->latest()->paginate(15);

        return view('gestations.index', compact('gestations'));
    }

    public function create()
    {
        // Solo hembras de las fincas del usuario
        $animals = Animal::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))
            ->where('sex', 'Femenino')
            ->get();

        return view('gestations.create', compact('animals'));
    }

    public function store(StoreGestationRecordRequest $request)
    {
        GestationRecord::create($request->validated());

        return redirect()->route('gestations.index')->with('success', 'Registro de gestación guardado.');
    }

    public function edit(GestationRecord $gestation)
    {
        $this->authorizeOwner($gestation);
        $animals = Animal::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))
            ->where('sex', 'Femenino')
            ->get();

        return view('gestations.edit', compact('gestation', 'animals'));
    }

    public function update(UpdateGestationRecordRequest $request, GestationRecord $gestation)
    {
        $this->authorizeOwner($gestation);
        $gestation->update($request->validated());

        return redirect()->route('gestations.index')->with('success', 'Registro de gestación actualizado.');
    }

    public function destroy(GestationRecord $gestation)
    {
        $this->authorizeOwner($gestation);
        $gestation->delete();

        return redirect()->route('gestations.index')->with('success', 'Registro eliminado.');
    }

    private function authorizeOwner(GestationRecord $gestation)
    {
        if ($gestation->animal->farm->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
