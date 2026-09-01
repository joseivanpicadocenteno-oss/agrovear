<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Http\Requests\StoreFarmRequest;
use App\Http\Requests\UpdateFarmRequest;

class FarmController extends Controller
{
    public function index()
    {
        $farms = Farm::where('user_id', auth()->id())->latest()->paginate(15);
        return view('farms.index', compact('farms'));
    }

    public function create()
    {
        return view('farms.create');
    }

    public function store(StoreFarmRequest $request)
    {
        // Obtenemos los datos ya validados por el FormRequest
        $validated = $request->validated();
        
        // Le asignamos el ID del usuario autenticado en la sesión
        $validated['user_id'] = auth()->id();
    
        // Creamos la finca
        Farm::create($validated);
    
        // Redireccionamos a la lista con mensaje flash de éxito
        return redirect()->route('farms.index')->with('success', 'Finca guardada exitosamente.');
    }
    
    public function show(Farm $farm)
    {
        $this->authorizeOwner($farm);
        $farm->load(['animals', 'products', 'recipes']);

        return view('farms.show', compact('farm'));
    }

    public function edit(Farm $farm)
    {
        $this->authorizeOwner($farm);
        return view('farms.edit', compact('farm'));
    }

    public function update(UpdateFarmRequest $request, Farm $farm)
    {
        $this->authorizeOwner($farm);
        $farm->update($request->validated());

        return redirect()->route('farms.index')->with('success', 'Finca actualizada correctamente.');
    }

    public function destroy(Farm $farm)
    {
        $this->authorizeOwner($farm);
        $farm->delete();

        return redirect()->route('farms.index')->with('success', 'Finca eliminada.');
    }

    private function authorizeOwner(Farm $farm)
    {
        if ($farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso sobre esta finca.');
        }
    }
}