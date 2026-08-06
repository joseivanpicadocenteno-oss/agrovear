<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Product::with('farm:id,name')
                ->whereHas('farm', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->orderBy('name')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $farm = auth()->user()->farms()->find($request->farm_id);

        if (!$farm) {
            return response()->json([
                'message' => 'No tienes permiso para agregar productos a esta granja.'
            ],403);
        }

        $product = Product::create($request->validated());

        return response()->json([
            'message' => 'Producto creado correctamente',
            'data' => $product->load('farm:id,name')
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load([
            'farm:id,name,user_id',
            'recipeDetails.recipe:id,name',
            'treatmentDetails.treatment:id,name'
        ]);

        if ($product->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para acceder a este producto.'
            ],403);
        }

        unset($product->farm->user_id);

        return response()->json(
            $product->makeHidden(['farm_id'])
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->load('farm:id,user_id');

        if ($product->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para modificar este producto.'
            ], 403);
        }

        if ($request->filled('farm_id')) {

            $farm = auth()->user()->farms()->find($request->farm_id);

            if (!$farm) {
                return response()->json([
                    'message' => 'No puedes mover el producto a una granja que no te pertenece.'
                ], 403);
            }
        }

        $product->update($request->validated());

        return response()->json([
            'message' => 'Producto actualizado correctamente',
            'data' => $product->load('farm:id,name')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->load('farm:id,user_id');

        if ($product->farm->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para eliminar este producto.'
            ], 403);
        }

        $product->delete();

        return response()->json([
            'message' => 'Producto eliminado correctamente'
        ]);
    }
}