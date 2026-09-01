<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Http\Requests\StoreFarmRequest;
use App\Http\Requests\UpdateFarmRequest;

class FarmController extends Controller
{
    public function index()
    {
        $farms = Farm::where('user_id', auth()->id())
            ->withCount(['animals', 'products', 'recipes'])
            ->get();

        return view('farms.index', compact('farms'));
    }

    public function create()
    {
        return view('farms.create');
    }

    public function store(StoreFarmRequest $request)
    {
        Farm::create([
            ...$request->validated(),
            'user_id' => auth()->id()
        ]);

        return redirect()->route('farms.index')->with('success', 'Granja registrada correctamente.');
    }

    public function edit(Farm $farm)
    {
        if ($farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta finca.');
        }

        return view('farms.edit', compact('farm'));
    }

    public function update(UpdateFarmRequest $request, Farm $farm)
    {
        if ($farm->user_id !== auth()->id()) {
            abort(403);
        }

        $farm->update($request->validated());

        return redirect()->route('farms.index')->with('success', 'Granja actualizada correctamente.');
    }

    public function destroy(Farm $farm)
    {
        if ($farm->user_id !== auth()->id()) {
            abort(403);
        }

        $farm->delete();

        return redirect()->route('farms.index')->with('success', 'Granja eliminada correctamente.');
    }
}
