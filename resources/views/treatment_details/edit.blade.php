@extends('layouts.app')

@section('title', 'Editar Ingrediente')
@section('page_title', 'Editar ingrediente')

@section('content')

<div class="max-w-3xl mx-auto">

```
{{-- Encabezado --}}
<div class="mb-6">

    <div class="flex flex-wrap items-center gap-2 mb-4">

        <a
            href="{{ route('recipe-details.index') }}"
            class="px-4 py-2 rounded-lg border border-stone-300 bg-white text-[#603813] text-sm font-semibold hover:bg-stone-50"
        >
            ← Ingredientes
        </a>

        <a
            href="{{ route('recipe-details.show', $recipeDetail) }}"
            class="px-4 py-2 rounded-lg border border-stone-300 bg-white text-[#603813] text-sm font-semibold hover:bg-stone-50"
        >
            Ver ingrediente
        </a>

    </div>


    <h2 class="font-heading font-bold text-2xl text-tierra-fertil">
        Editar ingrediente
    </h2>

    <p class="text-sm text-stone-500 mt-1">
        Actualiza el producto, cantidad o instrucción.
    </p>

</div>


<div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

    <div class="p-6 border-b border-stone-100">

        <h3 class="font-heading font-bold text-base text-tierra-fertil">
            Datos del ingrediente
        </h3>

    </div>


    <form
        action="{{ route('recipe-details.update', $recipeDetail) }}"
        method="POST"
        class="p-6 space-y-6"
    >

        @csrf
        @method('PUT')


        {{-- Receta --}}
        <div>

            <label
                for="recipe_id"
                class="block text-sm font-semibold text-tierra-fertil mb-1.5"
            >
                Receta <span class="text-red-500">*</span>
            </label>

            <select
                id="recipe_id"
                name="recipe_id"
                required
                class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm"
            >

                <option value="">
                    Selecciona una receta
                </option>

                @foreach($recipes as $recipe)

                    <option
                        value="{{ $recipe->id }}"
                        {{ old('recipe_id', $recipeDetail->recipe_id) == $recipe->id ? 'selected' : '' }}
                    >
                        {{ $recipe->name }}

                        @if($recipe->farm)
                            — {{ $recipe->farm->name }}
                        @endif
                    </option>

                @endforeach

            </select>

            @error('recipe_id')
                <span class="text-xs text-red-600 font-semibold">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- Producto --}}
        <div>

            <label
                for="product_id"
                class="block text-sm font-semibold text-tierra-fertil mb-1.5"
            >
                Producto <span class="text-red-500">*</span>
            </label>

            <select
                id="product_id"
                name="product_id"
                required
                class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm"
            >

                <option value="">
                    Selecciona un producto
                </option>

                @foreach($products as $product)

                    <option
                        value="{{ $product->id }}"
                        {{ old('product_id', $recipeDetail->product_id) == $product->id ? 'selected' : '' }}
                    >
                        {{ $product->name }}

                        @if($product->unit_measurement)
                            — {{ $product->unit_measurement }}
                        @endif
                    </option>

                @endforeach

            </select>

            @error('product_id')
                <span class="text-xs text-red-600 font-semibold">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- Cantidad --}}
        <div>

            <label
                for="quantity"
                class="block text-sm font-semibold text-tierra-fertil mb-1.5"
            >
                Cantidad <span class="text-red-500">*</span>
            </label>

            <input
                type="number"
                id="quantity"
                name="quantity"
                value="{{ old('quantity', $recipeDetail->quantity) }}"
                required
                min="0"
                step="0.01"
                class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm"
            >

            @error('quantity')
                <span class="text-xs text-red-600 font-semibold">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- Instrucción --}}
        <div>

            <label
                for="instruction"
                class="block text-sm font-semibold text-tierra-fertil mb-1.5"
            >
                Instrucción <span class="text-red-500">*</span>
            </label>

            <textarea
                id="instruction"
                name="instruction"
                rows="4"
                maxlength="255"
                required
                class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm resize-y"
            >{{ old('instruction', $recipeDetail->instruction) }}</textarea>

            @error('instruction')
                <span class="text-xs text-red-600 font-semibold">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- Botones --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-stone-100 pt-6">

            <a
                href="{{ route('recipe-details.show', $recipeDetail) }}"
                class="w-full sm:w-auto text-center px-5 py-3 rounded-xl border border-stone-300 text-stone-600 font-semibold text-sm hover:bg-stone-50"
            >
                Cancelar
            </a>


            <button
                type="submit"
                class="w-full sm:w-auto px-6 py-3 rounded-xl bg-verde-natural text-white font-heading font-bold text-sm hover:opacity-90"
            >
                Guardar cambios
            </button>

        </div>

    </form>

</div>
```

</div>

@endsection
