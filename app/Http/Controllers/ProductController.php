<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Farm;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('farm:id,name')
            ->whereHas('farm', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderBy('name')
            ->paginate(15);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $farms = auth()->user()->farms;
        return view('products.create', compact('farms'));
    }

    public function store(StoreProductRequest $request)
    {
        $farm = auth()->user()->farms()->find($request->farm_id);

        if (!$farm) {
            abort(403, 'No tienes permiso para agregar productos a esta granja.');
        }

        Product::create($request->validated());

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    public function show(Product $product)
    {
        $product->load([
            'farm:id,name,user_id',
            'recipeDetails.recipe:id,name',
            'treatmentDetails.treatment:id,name'
        ]);

        if ($product->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para acceder a este producto.');
        }

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('farm');

        if ($product->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este producto.');
        }

        $farms = auth()->user()->farms;
        return view('products.edit', compact('product', 'farms'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->load('farm:id,user_id');

        if ($product->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para modificar este producto.');
        }

        if ($request->filled('farm_id')) {
            $farm = auth()->user()->farms()->find($request->farm_id);

            if (!$farm) {
                abort(403, 'No puedes mover el producto a una granja que no te pertenece.');
            }
        }

        $product->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->load('farm:id,user_id');

        if ($product->farm->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este producto.');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }
}