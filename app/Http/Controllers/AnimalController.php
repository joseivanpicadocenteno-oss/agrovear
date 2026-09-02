<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Farm;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::with('farm:id,name')
            ->whereHas('farm', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderBy('name')
            ->paginate(15);

        return view('animals.index', compact('animals'));
    }

    public function create()
    {
        $farms = auth()->user()->farms;
        return view('animals.create', compact('farms'));
    }

    public function store(StoreAnimalRequest $request)
    {
        $farm = auth()->user()->farms()->find($request->farm_id);

        if (!$farm) {
            abort(403, 'No tienes permiso para agregar animales a esta granja.');
        }

        Animal::create($request->validated());

        return redirect()->route('animals.index')->with('success', 'Animal creado correctamente.');
    }

    public function show(Animal $animal)
    {
        $animal->load([
            'farm:id,name,user_id',
            'treatments:id,animal_id,start_date,end_date,active',
            'feedingRecords:id,animal_id,feeding_date',
            'gestationRecords:id,animal_id,service_date'
        ]);

        if ($animal->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para acceder a este animal.');
        }

        return view('animals.show', compact('animal'));
    }

    public function edit(Animal $animal)
    {
        $animal->load('farm');

        if ($animal->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este animal.');
        }

        $farms = auth()->user()->farms;
        return view('animals.edit', compact('animal', 'farms'));
    }

    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        $animal->load('farm:id,user_id');

        if ($animal->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para modificar este animal.');
        }

        if ($request->filled('farm_id')) {
            $farm = auth()->user()->farms()->find($request->farm_id);

            if (!$farm) {
                abort(403, 'No puedes mover el animal a una granja que no te pertenece.');
            }
        }

        $animal->update($request->validated());

        return redirect()->route('animals.index')->with('success', 'Animal actualizado correctamente.');
    }

    public function destroy(Animal $animal)
    {
        $animal->load('farm:id,user_id');
    
        if ($animal->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este animal.');
        }

        $animal->delete();

        return redirect()->route('animals.index')->with('success', 'Animal eliminado correctamente.');
    }
}