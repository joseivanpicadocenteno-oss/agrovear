@extends('layouts.app')

@section('title', 'Editar Alimentación')
@section('page_title', 'Editar Registro de Alimentación')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-6">

        <h2 class="text-2xl font-heading font-bold text-tierra-fertil">
            Editar Alimentación
        </h2>

        <p class="text-sm text-stone-500 mt-1">
            Modifica el registro del {{ $feeding->feeding_date?->format('d/m/Y') }}.
        </p>

    </div>

    <div class="bg-white p-8 rounded-xl shadow-sm border border-stone-200">

        <form action="{{ route('feedings.update', $feeding) }}"
              method="POST"
              class="space-y-6">

            @csrf
            @method('PUT')

            <div>

                <label for="animal_id"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Animal
                </label>

                <select id="animal_id"
                        name="animal_id"
                        required
                        class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">

                    @foreach($animals as $animal)

                        <option value="{{ $animal->id }}"
                            {{ old('animal_id', $feeding->animal_id) == $animal->id ? 'selected' : '' }}>

                            {{ $animal->name }}

                            @if($animal->farm)
                                — {{ $animal->farm->name }}
                            @endif

                        </option>

                    @endforeach

                </select>

                @error('animal_id')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            <div>

                <label for="recipe_id"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Receta alimenticia
                </label>

                <select id="recipe_id"
                        name="recipe_id"
                        required
                        class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">

                    @foreach($recipes as $recipe)

                        <option value="{{ $recipe->id }}"
                            {{ old('recipe_id', $feeding->recipe_id) == $recipe->id ? 'selected' : '' }}>

                            {{ $recipe->name }} — {{ $recipe->filter_species }}

                        </option>

                    @endforeach

                </select>

                @error('recipe_id')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label for="feeding_date"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Fecha
                    </label>

                    <input type="date"
                           id="feeding_date"
                           name="feeding_date"
                           value="{{ old('feeding_date', $feeding->feeding_date?->format('Y-m-d')) }}"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('feeding_date')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div>

                    <label for="amount_served"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Cantidad servida
                    </label>

                    <input type="number"
                           id="amount_served"
                           name="amount_served"
                           value="{{ old('amount_served', $feeding->amount_served) }}"
                           min="0"
                           step="0.01"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('amount_served')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

            <div class="rounded-xl bg-green-50 border border-green-200 p-4">

                <p class="text-sm font-semibold text-green-800">
                    Costo automático
                </p>

                <p class="text-xs text-green-700 mt-1">
                    Al guardar, Agrovear volverá a calcular el costo según la receta seleccionada.
                </p>

                <p class="text-sm font-bold text-green-800 mt-2">
                    Costo actual:
                    C$ {{ number_format((float) $feeding->estimated_feed_cost, 2) }}
                </p>

            </div>

            <div>

                <label for="gestation_record_id"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Registro de gestación
                    <span class="text-stone-400 font-normal">(opcional)</span>
                </label>

                <select id="gestation_record_id"
                        name="gestation_record_id"
                        class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">

                    <option value="">
                        -- No corresponde --
                    </option>

                    @foreach($gestationRecords as $gestation)

                        <option value="{{ $gestation->id }}"
                            {{ old('gestation_record_id', $feeding->gestation_record_id) == $gestation->id ? 'selected' : '' }}>

                            {{ $gestation->animal->name ?? 'Animal' }}
                            — Registro #{{ $gestation->id }}

                        </option>

                    @endforeach

                </select>

                @error('gestation_record_id')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            <div class="flex flex-col sm:flex-row justify-between gap-3 pt-5 border-t border-stone-100">

                <div class="flex gap-3">

                    <a href="{{ route('feedings.index') }}"
                       class="px-5 py-2.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm">
                        Cancelar
                    </a>

                    <a href="{{ route('feedings.show', $feeding) }}"
                       class="px-5 py-2.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm">
                        Ver registro
                    </a>

                </div>

                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold text-sm shadow-sm">
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</div>

@endsection