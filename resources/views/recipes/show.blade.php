@extends('layouts.app')

@section('title', $recipe->name)
@section('page_title', 'Ficha de Receta')

@section('content')

<div class="space-y-6">

    {{-- Encabezado --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 text-sm text-stone-500 mb-2">

                <a href="{{ route('recipes.index') }}"
                   class="hover:text-verde-natural">
                    Recetas
                </a>

                <span>/</span>

                <span>{{ $recipe->name }}</span>

            </div>

            <h1 class="text-3xl font-heading font-bold text-tierra-fertil">
                {{ $recipe->name }}
            </h1>

            <p class="text-stone-500 mt-2">
                {{ $recipe->filter_species }}
                ·
                {{ $recipe->frequent_use }}
            </p>

        </div>

        <div class="flex flex-wrap gap-2">

            <a href="{{ route('recipes.index') }}"
               class="px-4 py-2 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm transition">
                ← Recetas
            </a>

            <a href="{{ route('recipes.edit', $recipe) }}"
               class="px-4 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white font-semibold text-sm transition">
                Editar
            </a>

            <form action="{{ route('recipes.destroy', $recipe) }}"
                  method="POST"
                  onsubmit="return confirm('¿Estás seguro de eliminar esta receta? Esta acción no se puede deshacer.');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold text-sm transition">
                    Eliminar
                </button>

            </form>

        </div>

    </div>

    {{-- Resumen --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Especie
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ $recipe->filter_species }}
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Duración
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ $recipe->recommended_duration_days }} días
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Edad
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ $recipe->min_age_filter }} - {{ $recipe->max_age_filter }}
            </p>

            <p class="text-xs text-stone-400 mt-1">
                Edad mínima y máxima
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Peso mínimo
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ number_format((float) $recipe->min_weight_filter, 2) }} Kg
            </p>

        </div>

    </div>

    {{-- Información principal --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Información general --}}
        <div class="bg-white rounded-xl shadow-sm border border-stone-200">

            <div class="px-6 py-4 border-b border-stone-100">

                <h2 class="font-heading font-bold text-tierra-fertil">
                    Información de la receta
                </h2>

            </div>

            <div class="p-6 space-y-4">

                <div>

                    <p class="text-xs text-stone-400 uppercase font-bold">
                        Descripción
                    </p>

                    <p class="text-sm text-stone-700 mt-1">
                        {{ $recipe->description }}
                    </p>

                </div>

                <div>

                    <p class="text-xs text-stone-400 uppercase font-bold">
                        Objetivo
                    </p>

                    <p class="text-sm text-stone-700 mt-1">
                        {{ $recipe->objective }}
                    </p>

                </div>

                <div class="flex justify-between gap-4">

                    <span class="text-sm text-stone-500">
                        Frecuencia de uso
                    </span>

                    <span class="text-sm font-semibold text-stone-700 text-right">
                        {{ $recipe->frequent_use }}
                    </span>

                </div>

                <div class="flex justify-between gap-4">

                    <span class="text-sm text-stone-500">
                        Finca
                    </span>

                    <span class="text-sm font-semibold text-stone-700 text-right">
                        {{ $recipe->farm->name ?? 'Sin finca' }}
                    </span>

                </div>

            </div>

        </div>

        {{-- Compatibilidad --}}
        <div class="bg-white rounded-xl shadow-sm border border-stone-200">

            <div class="px-6 py-4 border-b border-stone-100">

                <h2 class="font-heading font-bold text-tierra-fertil">
                    Compatibilidad
                </h2>

            </div>

            <div class="p-6 space-y-4">

                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm text-stone-600">
                        Apta para gestación
                    </span>

                    @if($recipe->suitable_for_gestation)

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                            Sí
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                            No
                        </span>

                    @endif

                </div>

                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm text-stone-600">
                        Apta para localización
                    </span>

                    @if($recipe->suitable_for_location)

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                            Sí
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                            No
                        </span>

                    @endif

                </div>

                <div class="pt-4 border-t border-stone-100">

                    <p class="text-xs text-stone-400 uppercase font-bold">
                        Filtro de edad
                    </p>

                    <p class="text-sm text-stone-700 mt-1">
                        Desde {{ $recipe->min_age_filter }}
                        hasta {{ $recipe->max_age_filter }}
                    </p>

                </div>

                <div>

                    <p class="text-xs text-stone-400 uppercase font-bold">
                        Peso mínimo
                    </p>

                    <p class="text-sm text-stone-700 mt-1">
                        {{ number_format((float) $recipe->min_weight_filter, 2) }} Kg
                    </p>

                </div>

            </div>

        </div>

    </div>

    {{-- Productos --}}
    <div class="bg-white rounded-xl shadow-sm border border-stone-200">

        <div class="px-6 py-4 border-b border-stone-100">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="font-heading font-bold text-tierra-fertil">
                        Productos de la receta
                    </h2>

                    <p class="text-xs text-stone-500 mt-1">
                        Insumos asociados a esta receta.
                    </p>

                </div>

                <span class="px-2.5 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                    {{ $recipe->recipeDetails->count() }}
                </span>

            </div>

        </div>

        <div class="p-6">

            @if($recipe->recipeDetails->count())

                <div class="space-y-3">

                    @foreach($recipe->recipeDetails as $detail)

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border border-stone-100 rounded-lg p-4">

                            <div>

                                <p class="font-semibold text-stone-700">
                                    {{ $detail->product->name ?? 'Producto no disponible' }}
                                </p>

                                <p class="text-xs text-stone-400 mt-1">
                                    {{ $detail->product->type ?? '—' }}
                                </p>

                            </div>

                            <div class="text-sm text-stone-600">

                                <span class="font-semibold">
                                    Cantidad:
                                </span>

                                {{ number_format((float) $detail->quantity, 2) }}

                                {{ $detail->product->unit_measurement ?? '' }}

                            </div>

                            @if($detail->instruction)

                                <div class="text-xs text-stone-500 md:max-w-sm">

                                    <span class="font-semibold text-stone-600">
                                        Instrucción:
                                    </span>

                                    {{ $detail->instruction }}

                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>

            @else

                <div class="py-8 text-center">

                    <p class="text-sm text-stone-500">
                        Esta receta todavía no tiene productos asociados.
                    </p>

                    <p class="text-xs text-stone-400 mt-1">
                        Los productos se pueden configurar posteriormente en el detalle de la receta.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection