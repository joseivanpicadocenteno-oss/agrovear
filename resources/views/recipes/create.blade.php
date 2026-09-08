@extends('layouts.app')

@section('title', 'Nueva Receta')
@section('page_title', 'Crear Receta')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-6">

        <h2 class="text-2xl font-heading font-bold text-tierra-fertil">
            Crear Receta o Dieta
        </h2>

        <p class="text-sm text-stone-500 mt-1">
            Registra una receta para administrar la alimentación de los animales.
        </p>

    </div>

    <div class="bg-white p-8 rounded-xl shadow-sm border border-stone-200">

        <form action="{{ route('recipes.store') }}"
              method="POST"
              class="space-y-6">

            @csrf

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

                    <option value="" disabled {{ old('farm_id') ? '' : 'selected' }}>
                        -- Selecciona la finca --
                    </option>

                    @forelse($farms as $farm)

                        <option value="{{ $farm->id }}"
                            {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
                            {{ $farm->name }}
                        </option>

                    @empty

                        <option value="" disabled>
                            No tienes fincas activas registradas
                        </option>

                    @endforelse

                </select>

                @error('farm_id')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

                @if($farms->isEmpty())
                    <p class="text-xs text-red-600 mt-1">
                        Debes tener una finca activa para crear una receta.
                    </p>
                @endif

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
                       value="{{ old('name') }}"
                       maxlength="255"
                       required
                       placeholder="Ej: Dieta de crecimiento"
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
                          placeholder="Describe brevemente la receta o dieta..."
                          class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm resize-none">{{ old('description') }}</textarea>

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
                       value="{{ old('objective') }}"
                       maxlength="255"
                       required
                       placeholder="Ej: Mejorar el crecimiento y desarrollo"
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
                           value="{{ old('frequent_use') }}"
                           maxlength="255"
                           required
                           placeholder="Ej: Diaria"
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

                        <option value="" disabled {{ old('filter_species') ? '' : 'selected' }}>
                            -- Selecciona especie --
                        </option>

                        <option value="Porcino" {{ old('filter_species') == 'Porcino' ? 'selected' : '' }}>
                            Porcino
                        </option>

                        <option value="Bovino" {{ old('filter_species') == 'Bovino' ? 'selected' : '' }}>
                            Bovino
                        </option>

                        <option value="Ovino" {{ old('filter_species') == 'Ovino' ? 'selected' : '' }}>
                            Ovino
                        </option>

                        <option value="Caprino" {{ old('filter_species') == 'Caprino' ? 'selected' : '' }}>
                            Caprino
                        </option>

                        <option value="Aves" {{ old('filter_species') == 'Aves' ? 'selected' : '' }}>
                            Aves
                        </option>

                        <option value="Otro" {{ old('filter_species') == 'Otro' ? 'selected' : '' }}>
                            Otro
                        </option>

                    </select>

                    @error('filter_species')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

            {{-- Filtros de edad y peso --}}
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
                               value="{{ old('min_age_filter') }}"
                               min="0"
                               step="1"
                               required
                               placeholder="Ej: 0"
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
                               value="{{ old('max_age_filter') }}"
                               min="0"
                               step="1"
                               required
                               placeholder="Ej: 180"
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
                               value="{{ old('min_weight_filter') }}"
                               min="0"
                               step="0.01"
                               required
                               placeholder="Ej: 20.00"
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
                       value="{{ old('recommended_duration_days') }}"
                       min="1"
                       step="1"
                       required
                       placeholder="Ej: 30"
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
                               {{ old('suitable_for_gestation', true) ? 'checked' : '' }}
                               class="w-4 h-4 text-verde-natural rounded focus:ring-verde-natural">

                        <div>
                            <div class="font-semibold text-stone-700 text-sm">
                                Apta para gestación
                            </div>

                            <div class="text-xs text-stone-400">
                                Permitir el uso de esta receta durante la gestación.
                            </div>
                        </div>

                    </label>

                    <label class="flex items-center gap-3 p-4 rounded-lg border border-stone-200 hover:bg-stone-50 cursor-pointer">

                        <input type="hidden" name="suitable_for_location" value="0">

                        <input type="checkbox"
                               name="suitable_for_location"
                               value="1"
                               {{ old('suitable_for_location', true) ? 'checked' : '' }}
                               class="w-4 h-4 text-verde-natural rounded focus:ring-verde-natural">

                        <div>
                            <div class="font-semibold text-stone-700 text-sm">
                                Apta para esta localización
                            </div>

                            <div class="text-xs text-stone-400">
                                Permitir el uso de esta receta según la ubicación.
                            </div>
                        </div>

                    </label>

                </div>

            </div>

            {{-- Productos --}}
            <div class="border-t border-stone-100 pt-6">

                <h3 class="font-heading font-bold text-tierra-fertil mb-1">
                    Productos disponibles
                </h3>

                <p class="text-xs text-stone-500 mb-4">
                    Estos son los productos disponibles en tus fincas. La asociación con cantidades se configurará en el detalle de la receta.
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
                                            Stock:
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

                    <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">

                        <p class="text-sm font-semibold text-yellow-800">
                            No hay productos registrados.
                        </p>

                        <p class="text-xs text-yellow-700 mt-1">
                            Registra productos o insumos antes de configurar una receta.
                        </p>

                    </div>

                @endif

            </div>

            {{-- Botones --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-stone-100">

                <a href="{{ route('recipes.index') }}"
                   class="px-5 py-2.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm text-center transition">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold text-sm shadow-sm transition">
                    Guardar Receta
                </button>

            </div>

        </form>

    </div>

</div>

@endsection