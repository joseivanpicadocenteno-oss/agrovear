@extends('layouts.app')

@section('title', 'Recetas')
@section('page_title', 'Recetas y Dietas')

@section('content')

<div class="space-y-6">

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h2 class="text-2xl font-heading font-bold text-tierra-fertil">
                Recetas y Dietas
            </h2>

            <p class="text-sm text-stone-500 mt-1">
                Administra las dietas y recetas utilizadas para la alimentación de tus animales.
            </p>
        </div>

        <a href="{{ route('recipes.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2.5 rounded-lg shadow-sm transition">

            <span class="text-lg">+</span>
            Nueva Receta

        </a>

    </div>

    {{-- Tabla --}}
    <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden">

        @if($recipes->count())

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-stone-50 border-b border-stone-200">

                        <tr class="text-left">

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Receta
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Especie
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Finca
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Uso
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Duración
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Condiciones
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil text-right">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-stone-100">

                        @foreach($recipes as $recipe)

                            <tr class="hover:bg-stone-50 transition">

                                {{-- Nombre --}}
                                <td class="px-5 py-4">

                                    <div class="font-semibold text-tierra-fertil">
                                        {{ $recipe->name }}
                                    </div>

                                    <div class="text-xs text-stone-400 mt-1">
                                        {{ \Illuminate\Support\Str::limit($recipe->description, 70) }}
                                    </div>

                                </td>

                                {{-- Especie --}}
                                <td class="px-5 py-4">

                                    <span class="inline-flex px-2.5 py-1 rounded-full bg-green-50 text-green-700 text-xs font-semibold">
                                        {{ $recipe->filter_species }}
                                    </span>

                                </td>

                                {{-- Finca --}}
                                <td class="px-5 py-4 text-stone-600">
                                    {{ $recipe->farm->name ?? 'Sin finca' }}
                                </td>

                                {{-- Uso --}}
                                <td class="px-5 py-4 text-stone-600">
                                    {{ $recipe->frequent_use }}
                                </td>

                                {{-- Duración --}}
                                <td class="px-5 py-4">

                                    <span class="font-semibold text-stone-700">
                                        {{ $recipe->recommended_duration_days }}
                                    </span>

                                    <span class="text-xs text-stone-400">
                                        días
                                    </span>

                                </td>

                                {{-- Condiciones --}}
                                <td class="px-5 py-4">

                                    <div class="flex flex-wrap gap-1.5">

                                        @if($recipe->suitable_for_gestation)
                                            <span class="px-2 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-semibold">
                                                Gestación
                                            </span>
                                        @endif

                                        @if($recipe->suitable_for_location)
                                            <span class="px-2 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">
                                                Localización
                                            </span>
                                        @endif

                                    </div>

                                </td>

                                {{-- Acciones --}}
                                <td class="px-5 py-4">

                                    <div class="flex justify-end items-center gap-2">

                                        <a href="{{ route('recipes.show', $recipe) }}"
                                           class="px-3 py-1.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-100 text-xs font-semibold transition">
                                            Ver
                                        </a>

                                        <a href="{{ route('recipes.edit', $recipe) }}"
                                           class="px-3 py-1.5 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold transition">
                                            Editar
                                        </a>

                                        <form action="{{ route('recipes.destroy', $recipe) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Estás seguro de eliminar esta receta? Esta acción no se puede deshacer.');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="px-3 py-1.5 rounded-lg bg-red-600 hover:bg-red-700 text-white text-xs font-semibold transition">
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- Paginación --}}
            <div class="px-5 py-4 border-t border-stone-200">
                {{ $recipes->links() }}
            </div>

        @else

            {{-- Estado vacío --}}
            <div class="px-6 py-16 text-center">

                <div class="text-5xl mb-4">
                    🍃
                </div>

                <h3 class="text-lg font-heading font-bold text-tierra-fertil">
                    No hay recetas registradas
                </h3>

                <p class="text-sm text-stone-500 mt-2 mb-6">
                    Registra una receta o dieta para comenzar a gestionar la alimentación.
                </p>

                <a href="{{ route('recipes.create') }}"
                   class="inline-flex items-center gap-2 bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2.5 rounded-lg shadow-sm transition">
                    + Crear receta
                </a>

            </div>

        @endif

    </div>

</div>

@endsection