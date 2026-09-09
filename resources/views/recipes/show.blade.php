@extends('layouts.app')

@section('title', $recipe->name)
@section('page_title', 'Detalle de receta')

@section('content')

<div class="max-w-6xl mx-auto">

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
        href="{{ route('recipes.index') }}"
        class="px-4 py-2 rounded-lg border border-stone-300 bg-white text-[#603813] text-sm font-semibold hover:bg-stone-50"
    >
        ← Recetas
    </a>

</div>


{{-- Cabecera --}}
<div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden mb-6">

    <div class="p-6 lg:p-8">

        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">

            <div>

                <div class="flex flex-wrap items-center gap-2 mb-3">

                    <span class="px-3 py-1 rounded-full bg-green-50 text-verde-natural text-xs font-bold">
                        Receta alimenticia
                    </span>


                    @if($recipe->objective)

                        <span class="px-3 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                            {{ $recipe->objective }}
                        </span>

                    @endif

                </div>


                <h2 class="font-heading font-bold text-3xl text-tierra-fertil">
                    {{ $recipe->name }}
                </h2>


                <p class="text-sm text-stone-500 mt-2">

                    Finca:

                    <span class="font-semibold text-stone-700">
                        {{ $recipe->farm->name ?? 'Sin finca' }}
                    </span>

                </p>

            </div>


            <div class="flex flex-wrap gap-2">

                <a
                    href="{{ route('recipes.edit', $recipe) }}"
                    class="px-4 py-2.5 rounded-xl bg-amber-50 text-amber-700 text-sm font-bold hover:bg-amber-100"
                >
                    Editar receta
                </a>


                <form
                    action="{{ route('recipes.destroy', $recipe) }}"
                    method="POST"
                    onsubmit="return confirm('¿Seguro que deseas eliminar esta receta?')"
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


{{-- Contenido --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


    {{-- Columna principal --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Descripción --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm p-6">

            <h3 class="font-heading font-bold text-lg text-tierra-fertil">
                Descripción
            </h3>

            <p class="text-sm text-stone-600 mt-3 leading-6">
                {{ $recipe->description ?: 'Esta receta no tiene una descripción registrada.' }}
            </p>

        </div>


        {{-- Ingredientes --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="p-6 border-b border-stone-100">

                <div class="flex items-center justify-between gap-4">

                    <div>
                        <h3 class="font-heading font-bold text-lg text-tierra-fertil">
                            Ingredientes
                        </h3>

                        <p class="text-xs text-stone-500 mt-1">
                            Productos registrados en esta receta.
                        </p>
                    </div>


                    <span class="px-3 py-1.5 rounded-lg bg-green-50 text-verde-natural text-xs font-bold">
                        {{ $recipe->recipeDetails->count() }}
                        ingredientes
                    </span>

                </div>

            </div>


            <div class="p-6">

                @forelse($recipe->recipeDetails as $detail)

                    <div class="py-4 first:pt-0 border-b last:border-0 border-stone-100">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                            <div>

                                <p class="text-sm font-bold text-stone-700">
                                    {{ $detail->product->name ?? 'Producto eliminado' }}
                                </p>

                                <p class="text-xs text-stone-400 mt-1">
                                    {{ $detail->instruction }}
                                </p>

                            </div>


                            <div class="flex items-center gap-2">

                                <span class="px-3 py-1.5 rounded-lg bg-stone-100 text-stone-700 text-sm font-bold">
                                    {{ number_format((float) $detail->quantity, 2) }}
                                </span>


                                @if($detail->product?->unit_measurement)

                                    <span class="text-xs text-stone-400">
                                        {{ $detail->product->unit_measurement }}
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="py-8 text-center">

                        <p class="text-sm font-semibold text-stone-500">
                            No hay ingredientes registrados.
                        </p>


                        <a
                            href="{{ route('recipes.edit', $recipe) }}"
                            class="inline-block mt-3 text-xs font-bold text-verde-natural hover:underline"
                        >
                            Agregar ingredientes
                        </a>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- Columna lateral --}}
    <div class="space-y-6">

        {{-- Información --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm p-6">

            <h3 class="font-heading font-bold text-lg text-tierra-fertil">
                Información
            </h3>


            <div class="space-y-4 mt-5">

                <div>

                    <p class="text-xs text-stone-400">
                        Finca
                    </p>

                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $recipe->farm->name ?? 'Sin finca' }}
                    </p>

                </div>


                <div class="border-t border-stone-100 pt-4">

                    <p class="text-xs text-stone-400">
                        Objetivo
                    </p>

                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $recipe->objective ?: 'No definido' }}
                    </p>

                </div>


                <div class="border-t border-stone-100 pt-4">

                    <p class="text-xs text-stone-400">
                        Uso frecuente
                    </p>

                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $recipe->frequent_use ?: 'No definido' }}
                    </p>

                </div>


                <div class="border-t border-stone-100 pt-4">

                    <p class="text-xs text-stone-400">
                        Duración recomendada
                    </p>

                    <p class="text-sm font-semibold text-stone-700 mt-1">

                        @if($recipe->recommended_duration_days !== null)

                            {{ $recipe->recommended_duration_days }} días

                        @else

                            No definida

                        @endif

                    </p>

                </div>

            </div>

        </div>


        {{-- Aplicabilidad --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm p-6">

            <h3 class="font-heading font-bold text-lg text-tierra-fertil">
                Aplicabilidad
            </h3>


            <div class="space-y-4 mt-5">

                <div>

                    <p class="text-xs text-stone-400">
                        Especie
                    </p>

                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $recipe->filter_species ?: 'Todas las especies' }}
                    </p>

                </div>


                <div class="grid grid-cols-2 gap-4 border-t border-stone-100 pt-4">

                    <div>

                        <p class="text-xs text-stone-400">
                            Edad mínima
                        </p>

                        <p class="text-sm font-semibold text-stone-700 mt-1">
                            {{ $recipe->min_age_filter !== null
                                ? $recipe->min_age_filter . ' meses'
                                : '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-stone-400">
                            Edad máxima
                        </p>

                        <p class="text-sm font-semibold text-stone-700 mt-1">
                            {{ $recipe->max_age_filter !== null
                                ? $recipe->max_age_filter . ' meses'
                                : '—' }}
                        </p>

                    </div>

                </div>


                <div class="border-t border-stone-100 pt-4">

                    <p class="text-xs text-stone-400">
                        Peso mínimo
                    </p>

                    <p class="text-sm font-semibold text-stone-700 mt-1">

                        {{ $recipe->min_weight_filter !== null
                            ? number_format((float) $recipe->min_weight_filter, 2) . ' kg'
                            : 'No definido' }}

                    </p>

                </div>


                <div class="border-t border-stone-100 pt-4 space-y-3">

                    <div class="flex items-center justify-between">

                        <span class="text-xs text-stone-500">
                            Apta para gestación
                        </span>

                        <span class="text-xs font-bold {{ $recipe->suitable_for_gestation ? 'text-green-700' : 'text-stone-400' }}">
                            {{ $recipe->suitable_for_gestation ? 'Sí' : 'No' }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between">

                        <span class="text-xs text-stone-500">
                            Apta para ubicación
                        </span>

                        <span class="text-xs font-bold {{ $recipe->suitable_for_location ? 'text-green-700' : 'text-stone-400' }}">
                            {{ $recipe->suitable_for_location ? 'Sí' : 'No' }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- Acciones --}}
<div class="bg-tierra-fertil rounded-2xl p-6 mt-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <h3 class="font-heading font-bold text-white">
                Gestionar receta
            </h3>

            <p class="text-sm text-stone-300 mt-1">
                Continúa administrando esta receta.
            </p>

        </div>


        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('recipes.edit', $recipe) }}"
                class="px-4 py-2.5 rounded-xl bg-white text-tierra-fertil text-sm font-bold hover:bg-stone-100"
            >
                Editar ingredientes
            </a>


            <a
                href="{{ route('feedings.create') }}"
                class="px-4 py-2.5 rounded-xl bg-secondary text-white text-sm font-bold hover:opacity-90"
            >
                Registrar alimentación
            </a>

        </div>

    </div>

</div>
```

</div>

@endsection
