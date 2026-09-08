<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        $query = Animal::with('farm:id,name')
            ->whereHas('farm', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });

        // Búsqueda
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('breed', 'like', "%{$search}%");
            });
        }

        // Filtro por especie
        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        // Filtro por sexo
        if ($request->filled('sex')) {
            $query->where('sex', $request->sex);
        }

        // Filtro por estado
        if ($request->filled('active')) {
            $query->where('active', $request->active);
        }

        // Filtro por finca
        if ($request->filled('farm_id')) {
            $query->where('farm_id', $request->farm_id);
        }

        $animals = $query
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        // Estadísticas
        $baseQuery = Animal::whereHas('farm', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'active' => (clone $baseQuery)->where('active', true)->count(),
            'inactive' => (clone $baseQuery)->where('active', false)->count(),
            'females' => (clone $baseQuery)->where('sex', 'Hembra')->count(),
            'males' => (clone $baseQuery)->where('sex', 'Macho')->count(),
        ];

        $farms = auth()->user()
            ->farms()
            ->orderBy('name')
            ->get();

        return view('animals.index', compact(
            'animals',
            'stats',
            'farms'
        ));
    }

    public function create()
    {
        $farms = auth()->user()
            ->farms()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        return view('animals.create', compact('farms'));
    }

    public function store(StoreAnimalRequest $request)
    {
        $farm = auth()->user()
            ->farms()
            ->where('active', true)
            ->find($request->farm_id);

        if (!$farm) {
            abort(403, 'No tienes permiso para agregar animales a esta finca.');
        }

        $data = $request->validated();

        $data['active'] = $request->has('active')
            ? $request->boolean('active')
            : true;

        Animal::create($data);

        return redirect()
            ->route('animals.index')
            ->with('success', 'Animal registrado correctamente.');
    }

    public function show(Animal $animal)
    {
        $animal->load([
            'farm:id,name,user_id',

            'treatments' => function ($query) {
                $query->select([
                    'id',
                    'animal_id',
                    'name',
                    'start_date',
                    'end_date',
                    'diagnosis',
                    'observations',
                    'active',
                ])->latest('start_date');
            },

            'feedingRecords' => function ($query) {
                $query->select([
                    'id',
                    'animal_id',
                    'feeding_date',
                    'amount_served',
                    'estimated_feed_cost',
                    'recipe_id',
                ])->latest('feeding_date');
            },

            'feedingRecords.recipe:id,name',

            'gestationRecords' => function ($query) {
                $query->select([
                    'id',
                    'animal_id',
                    'service_date',
                    'estimated_birth_date',
                    'actual_birth_date',
                    'live_births',
                    'stillbirths',
                    'observations',
                    'active',
                ])->latest('service_date');
            },
        ]);

        if (!$animal->farm || $animal->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para acceder a este animal.');
        }

        return view('animals.show', compact('animal'));
    }

    public function edit(Animal $animal)
    {
        $animal->load('farm:id,name,user_id');

        if (!$animal->farm || $animal->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este animal.');
        }

        $farms = auth()->user()
            ->farms()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        return view('animals.edit', compact(
            'animal',
            'farms'
        ));
    }

    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        $animal->load('farm:id,user_id');

        if (!$animal->farm || $animal->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para modificar este animal.');
        }

        $farm = auth()->user()
            ->farms()
            ->where('active', true)
            ->find($request->farm_id);

        if (!$farm) {
            abort(
                403,
                'No puedes mover el animal a una finca que no te pertenece o está inactiva.'
            );
        }

        $data = $request->validated();
        $data['active'] = $request->boolean('active');

        $animal->update($data);

        return redirect()
            ->route('animals.show', $animal)
            ->with('success', 'Animal actualizado correctamente.');
    }

    public function destroy(Animal $animal)
    {
        $animal->load('farm:id,user_id');

        if (!$animal->farm || $animal->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este animal.');
        }

        $animal->delete();

        return redirect()
            ->route('animals.index')
            ->with('success', 'Animal eliminado correctamente.');
    }
}