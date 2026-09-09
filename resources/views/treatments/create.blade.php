@extends('layouts.app')

@section('title', 'Nuevo Tratamiento')
@section('page_title', 'Registrar Tratamiento')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-6">

        <h2 class="text-2xl font-heading font-bold text-tierra-fertil">
            Registrar Tratamiento Veterinario
        </h2>

        <p class="text-sm text-stone-500 mt-1">
            Registra el diagnóstico y seguimiento del tratamiento de un animal.
        </p>

    </div>

    <div class="bg-white p-8 rounded-xl shadow-sm border border-stone-200">

        <form action="{{ route('treatments.store') }}"
              method="POST"
              class="space-y-6">

            @csrf

            {{-- Animal --}}
            <div>

                <label for="animal_id"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Animal
                </label>

                <select id="animal_id"
                        name="animal_id"
                        required
                        class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">

                    <option value="" disabled {{ old('animal_id') ? '' : 'selected' }}>
                        -- Selecciona el animal --
                    </option>

                    @forelse($animals as $animal)

                        <option value="{{ $animal->id }}"
                            {{ old('animal_id') == $animal->id ? 'selected' : '' }}>

                            {{ $animal->name }}

                            @if($animal->farm)
                                — {{ $animal->farm->name }}
                            @endif

                        </option>

                    @empty

                        <option value="" disabled>
                            No hay animales registrados
                        </option>

                    @endforelse

                </select>

                @error('animal_id')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Nombre --}}
            <div>

                <label for="name"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Nombre del tratamiento
                </label>

                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       maxlength="255"
                       required
                       placeholder="Ej: Tratamiento antibiótico"
                       class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                @error('name')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Fechas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label for="start_date"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Fecha y hora de inicio
                    </label>

                    <input type="datetime-local"
                           id="start_date"
                           name="start_date"
                           value="{{ old('start_date') }}"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('start_date')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div>

                    <label for="end_date"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Fecha y hora de finalización
                    </label>

                    <input type="datetime-local"
                           id="end_date"
                           name="end_date"
                           value="{{ old('end_date') }}"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('end_date')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

            {{-- Diagnóstico --}}
            <div>

                <label for="diagnosis"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Diagnóstico
                </label>

                <textarea id="diagnosis"
                          name="diagnosis"
                          rows="3"
                          maxlength="500"
                          required
                          placeholder="Describe el diagnóstico veterinario..."
                          class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm resize-none">{{ old('diagnosis') }}</textarea>

                @error('diagnosis')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Observaciones --}}
            <div>

                <label for="observations"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Observaciones
                </label>

                <textarea id="observations"
                          name="observations"
                          rows="4"
                          maxlength="255"
                          placeholder="Observaciones adicionales sobre el tratamiento..."
                          class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm resize-none">{{ old('observations') }}</textarea>

                @error('observations')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Estado --}}
            <div>

                <label class="flex items-center gap-3 p-4 rounded-lg border border-stone-200 hover:bg-stone-50 cursor-pointer">

                    <input type="hidden" name="active" value="0">

                    <input type="checkbox"
                           name="active"
                           value="1"
                           {{ old('active', true) ? 'checked' : '' }}
                           class="w-4 h-4 text-verde-natural rounded focus:ring-verde-natural">

                    <div>

                        <div class="font-semibold text-stone-700 text-sm">
                            Tratamiento activo
                        </div>

                        <div class="text-xs text-stone-400">
                            Mantener este tratamiento como activo.
                        </div>

                    </div>

                </label>

            </div>

            {{-- Productos --}}
            <div class="border-t border-stone-100 pt-6">

                <h3 class="font-heading font-bold text-tierra-fertil mb-1">
                    Productos disponibles
                </h3>

                <p class="text-xs text-stone-500 mb-4">
                    Productos registrados en tus fincas que pueden utilizarse en tratamientos.
                </p>

                @if($products->count())

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                        @foreach($products as $product)

                            <div class="border border-stone-200 rounded-lg p-4">

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

                                <p class="text-xs text-stone-400 mt-1">
                                    {{ $product->farm->name ?? 'Sin finca' }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">

                        <p class="text-sm font-semibold text-yellow-800">
                            No hay productos registrados.
                        </p>

                        <p class="text-xs text-yellow-700 mt-1">
                            Registra productos antes de asociarlos a un tratamiento.
                        </p>

                    </div>

                @endif

            </div>

            {{-- Botones --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-stone-100">

                <a href="{{ route('treatments.index') }}"
                   class="px-5 py-2.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm text-center">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold text-sm">
                    Guardar Tratamiento
                </button>

            </div>

        </form>

    </div>

</div>

@endsection