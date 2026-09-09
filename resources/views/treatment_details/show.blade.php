@extends('layouts.app')

@section('title', 'Detalle del Ingrediente')
@section('page_title', 'Detalle del ingrediente')

@section('content')

<div class="max-w-4xl mx-auto">

```
{{-- Navegación --}}
<div class="flex flex-wrap items-center gap-2 mb-6">

    <a
        href="{{ route('dashboard') }}"
        class="px-4 py-2 rounded-lg border border-stone-300 bg-white text-[#603813] text-sm font-semibold hover:bg-stone-50"
    >
        ← Dashboard
    </a>

    <a
        href="{{ route('recipe-details.index') }}"
        class="px-4 py-2 rounded-lg border border-stone-300 bg-white text-[#603813] text-sm font-semibold hover:bg-stone-50"
    >
        ← Ingredientes
    </a>

    <a
        href="{{ route('recipes.show', $recipeDetail->recipe) }}"
        class="px-4 py-2 rounded-lg border border-stone-300 bg-white text-[#603813] text-sm font-semibold hover:bg-stone-50"
    >
        Ver receta
    </a>

</div>


{{-- Cabecera --}}
<div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

    <div class="p-6 lg:p-8">

        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">

            <div>

                <span class="inline-flex px-3 py-1 rounded-full bg-green-50 text-verde-natural text-xs font-bold mb-3">
                    Ingrediente
                </span>

                <h2 class="font-heading font-bold text-3xl text-tierra-fertil">
                    {{ $recipeDetail->product->name ?? 'Producto eliminado' }}
                </h2>

                <p class="text-sm text-stone-500 mt-2">
                    Receta:

                    <a
                        href="{{ route('recipes.show', $recipeDetail->recipe) }}"
                        class="font-semibold text-verde-natural hover:underline"
                    >
                        {{ $recipeDetail->recipe->name ?? 'Sin receta' }}
                    </a>
                </p>

                <p class="text-sm text-stone-500 mt-1">
                    Finca:
                    <span class="font-semibold text-stone-700">
                        {{ $recipeDetail->recipe->farm->name ?? 'Sin finca' }}
                    </span>
                </p>

            </div>


            <div class="flex flex-wrap gap-2">

                <a
                    href="{{ route('recipe-details.edit', $recipeDetail) }}"
                    class="px-4 py-2.5 rounded-xl bg-amber-50 text-amber-700 text-sm font-bold hover:bg-amber-100"
                >
                    Editar
                </a>


                <form
                    action="{{ route('recipe-details.destroy', $recipeDetail) }}"
                    method="POST"
                    onsubmit="return confirm('¿Seguro que deseas eliminar este ingrediente?')"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="px-4 py-2.5 rounded-xl bg-red-50 text-red-600 text-sm font-bold hover:bg-red-100"
                    >
                        Eliminar
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>


{{-- Información --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

    {{-- Producto --}}
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm p-6">

        <h3 class="font-heading font-bold text-lg text-tierra-fertil">
            Producto
        </h3>

        <div class="mt-5">

            <p class="text-xl font-bold text-stone-700">
                {{ $recipeDetail->product->name ?? 'Producto eliminado' }}
            </p>

            @if($recipeDetail->product?->unit_measurement)

                <p class="text-sm text-stone-400 mt-2">
                    Unidad de medida:
                    <span class="font-semibold text-stone-600">
                        {{ $recipeDetail->product->unit_measurement }}
                    </span>
                </p>

            @endif

        </div>

    </div>


    {{-- Cantidad --}}
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm p-6">

        <h3 class="font-heading font-bold text-lg text-tierra-fertil">
            Cantidad
        </h3>

        <div class="mt-5 flex items-end gap-2">

            <span class="font-heading font-bold text-3xl text-verde-natural">
                {{ number_format((float) $recipeDetail->quantity, 2) }}
            </span>

            @if($recipeDetail->product?->unit_measurement)

                <span class="text-sm text-stone-400 mb-1">
                    {{ $recipeDetail->product->unit_measurement }}
                </span>

            @endif

        </div>

    </div>

</div>


{{-- Instrucción --}}
<div class="bg-white border border-stone-200 rounded-2xl shadow-sm p-6 mt-6">

    <h3 class="font-heading font-bold text-lg text-tierra-fertil">
        Instrucción
    </h3>

    <div class="mt-4 rounded-xl bg-stone-50 border border-stone-200 p-5">

        <p class="text-sm text-stone-700 leading-6">
            {{ $recipeDetail->instruction }}
        </p>

    </div>

</div>


{{-- Resumen --}}
<div class="bg-tierra-fertil rounded-2xl p-6 mt-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <h3 class="font-heading font-bold text-white">
                {{ $recipeDetail->recipe->name ?? 'Receta' }}
            </h3>

            <p class="text-sm text-stone-300 mt-1">
                Este ingrediente forma parte de la receta seleccionada.
            </p>

        </div>


        <a
            href="{{ route('recipes.show', $recipeDetail->recipe) }}"
            class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-white text-tierra-fertil text-sm font-bold hover:bg-stone-100"
        >
            Ver receta completa
        </a>

    </div>

</div>
```

</div>

@endsection
