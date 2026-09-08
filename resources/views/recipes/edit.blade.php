@extends('layouts.app')

@section('title', 'Editar Receta')
@section('page_title', 'Editar Receta')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">

        <div>

            <h2 class="text-2xl font-heading font-bold text-tierra-fertil">
                Editar Receta
            </h2>

            <p class="text-sm text-stone-500 mt-1">
                Modifica la información de {{ $recipe->name }}.
            </p>

        </div>

        <a href="{{ route('recipes.show', $recipe) }}"
           class="text-sm font-semibold text-verde-natural hover:underline">
            ← Ver receta
        </a>

    </div>

    <div class="bg-white p-8 rounded-xl shadow-sm border border-stone-200">

        <form action="{{ route('recipes.update', $recipe) }}"
              method="POST"
              class="space-y-6">

            @csrf
            @method('PUT')

            {{-- Finca --}}
            <div>

                <label for="farm_id"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Finca
                </label>

                <select id="farm_id"
                        name="farm_id"
                        required
                        class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">

                    @foreach($farms as $farm)

                        <option value="{{ $farm->id }}"
                            {{ old('farm_id', $recipe->farm_id) == $farm->id ? 'selected' : '' }}>
                            {{ $farm->name }}
                        </option>

                    @endforeach

                </select>

                @error('farm_id')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Nombre --}}
            <div>

                <label for="name"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Nombre de la receta
                </label>

                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $recipe->name) }}"
                       maxlength="255"
                       required
                       class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                @error('name')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Descripción --}}
            <div>

                <label for="description"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Descripción
                </label>

                <textarea id="description"
                          name="description"
                          rows="3"
                          maxlength="255"
                          required
                          class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm resize-none">{{ old('description', $recipe->description) }}</textarea>

                @error('description')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Objetivo --}}
            <div>

                <label for="objective"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Objetivo
                </label>

                <input type="text"
                       id="objective"
                       name="objective"
                       value="{{ old('objective', $recipe->objective) }}"
                       maxlength="255"
                       required
                       class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                @error('objective')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Frecuencia / Especie --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label for="frequent_use"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Frecuencia de uso
                    </label>

                    <input type="text"
                           id="frequent_use"
                           name="frequent_use"
                           value="{{ old('frequent_use', $recipe->frequent_use) }}"
                           maxlength="255"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('frequent_use')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div>

                    <label for="filter_species"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Especie animal
                    </label>

                    <select id="filter_species"
                            name="filter_species"
                            required
                            class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">

                        @foreach(['Porcino', 'Bovino', 'Ovino', 'Caprino', 'Aves', 'Otro'] as $species)

                            <option value="{{ $species }}"
                                {{ old('filter_species', $recipe->filter_species) == $species ? 'selected' : '' }}>
                                {{ $species }}
                            </option>

                        @endforeach

                    </select>

                    @error('filter_species')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

            {{-- Filtros --}}
            <div class="border-t border-stone-100 pt-6">

                <h3 class="font-heading font-bold text-tierra-fertil mb-4">
                    Filtros de aplicación
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>

                        <label for="min_age_filter"
                               class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                            Edad mínima
                        </label>

                        <input type="number"
                               id="min_age_filter"
                               name="min_age_filter"
                               value="{{ old('min_age_filter', $recipe->min_age_filter) }}"
                               min="0"
                               step="1"
                               required
                               class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                        @error('min_age_filter')
                            <span class="text-xs text-red-600 font-semibold">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div>

                        <label for="max_age_filter"
                               class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                            Edad máxima
                        </label>

                        <input type="number"
                               id="max_age_filter"
                               name="max_age_filter"
                               value="{{ old('max_age_filter', $recipe->max_age_filter) }}"
                               min="0"
                               step="1"
                               required
                               class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                        @error('max_age_filter')
                            <span class="text-xs text-red-600 font-semibold">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div>

                        <label for="min_weight_filter"
                               class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                            Peso mínimo (Kg)
                        </label>

                        <input type="number"
                               id="min_weight_filter"
                               name="min_weight_filter"
                               value="{{ old('min_weight_filter', $recipe->min_weight_filter) }}"
                               min="0"
                               step="0.01"
                               required
                               class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                        @error('min_weight_filter')
                            <span class="text-xs text-red-600 font-semibold">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>

            </div>

            {{-- Duración --}}
            <div>

                <label for="recommended_duration_days"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Duración recomendada (días)
                </label>

                <input type="number"
                       id="recommended_duration_days"
                       name="recommended_duration_days"
                       value="{{ old('recommended_duration_days', $recipe->recommended_duration_days) }}"
                       min="1"
                       step="1"
                       required
                       class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                @error('recommended_duration_days')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Compatibilidad --}}
            <div class="border-t border-stone-100 pt-6">

                <h3 class="font-heading font-bold text-tierra-fertil mb-4">
                    Compatibilidad
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <label class="flex items-center gap-3 p-4 rounded-lg border border-stone-200 hover:bg-stone-50 cursor-pointer">

                        <input type="hidden" name="suitable_for_gestation" value="0">

                        <input type="checkbox"
                               name="suitable_for_gestation"
                               value="1"
                               {{ old('suitable_for_gestation', $recipe->suitable_for_gestation) ? 'checked' : '' }}
                               class="w-4 h-4 text-verde-natural rounded focus:ring-verde-natural">

                        <div>
                            <div class="font-semibold text-stone-700 text-sm">
                                Apta para gestación
                            </div>

                            <div class="text-xs text-stone-400">
                                Permitir el uso durante la gestación.
                            </div>
                        </div>

                    </label>

                    <label class="flex items-center gap-3 p-4 rounded-lg border border-stone-200 hover:bg-stone-50 cursor-pointer">

                        <input type="hidden" name="suitable_for_location" value="0">

                        <input type="checkbox"
                               name="suitable_for_location"
                               value="1"
                               {{ old('suitable_for_location', $recipe->suitable_for_location) ? 'checked' : '' }}
                               class="w-4 h-4 text-verde-natural rounded focus:ring-verde-natural">

                        <div>
                            <div class="font-semibold text-stone-700 text-sm">
                                Apta para esta localización
                            </div>

                            <div class="text-xs text-stone-400">
                                Permitir el uso según la ubicación.
                            </div>
                        </div>

                    </label>

                </div>

            </div>

            {{-- Productos disponibles --}}
            <div class="border-t border-stone-100 pt-6">

                <h3 class="font-heading font-bold text-tierra-fertil mb-1">
                    Productos disponibles
                </h3>

                <p class="text-xs text-stone-500 mb-4">
                    Productos disponibles para asociar a esta receta.
                </p>

                @if($products->count())

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                        @foreach($products as $product)

                            <div class="border border-stone-200 rounded-lg p-4">

                                <div class="flex items-center justify-between gap-3">

                                    <div>

                                        <p class="font-semibold text-stone-700 text-sm">
                                            {{ $product->name }}
                                        </p>

                                        <p class="text-xs text-stone-400 mt-1">
                                            {{ $product->type }}
                                            ·
                                            {{ number_format((float) $product->current_stock, 2) }}
                                            {{ $product->unit_measurement }}
                                        </p>

                                    </div>

                                    <span class="text-xs px-2 py-1 rounded-full bg-stone-100 text-stone-600">
                                        {{ $product->farm->name ?? 'Sin finca' }}
                                    </span>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <p class="text-sm text-stone-500">
                        No hay productos disponibles para esta receta.
                    </p>

                @endif

            </div>

            {{-- Botones --}}
            <div class="flex flex-col sm:flex-row justify-between gap-3 pt-5 border-t border-stone-100">

                <div class="flex gap-3">

                    <a href="{{ route('recipes.index') }}"
                       class="px-5 py-2.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm text-center transition">
                        Cancelar
                    </a>

                    <a href="{{ route('recipes.show', $recipe) }}"
                       class="px-5 py-2.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm text-center transition">
                        Ver receta
                    </a>

                </div>

                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold text-sm shadow-sm transition">
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</div>

@endsection