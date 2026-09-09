@extends('layouts.app')

@section('title', 'Nueva Gestación')
@section('page_title', 'Registrar Gestación')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-6">

        <h2 class="text-2xl font-heading font-bold text-tierra-fertil">
            Registrar Gestación
        </h2>

        <p class="text-sm text-stone-500 mt-1">
            Registra el servicio y seguimiento reproductivo de una hembra.
        </p>

    </div>

    <div class="bg-white p-8 rounded-xl shadow-sm border border-stone-200">

        <form action="{{ route('gestations.store') }}"
              method="POST"
              class="space-y-6">

            @csrf

            {{-- Animal --}}
            <div>

                <label for="animal_id"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Hembra
                </label>

                <select id="animal_id"
                        name="animal_id"
                        required
                        class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">

                    <option value="" disabled {{ old('animal_id') ? '' : 'selected' }}>
                        -- Selecciona una hembra --
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
                            No hay hembras registradas
                        </option>

                    @endforelse

                </select>

                @error('animal_id')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Fechas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label for="service_date"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Fecha del servicio
                    </label>

                    <input type="date"
                           id="service_date"
                           name="service_date"
                           value="{{ old('service_date') }}"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('service_date')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div>

                    <label for="estimated_birth_date"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Fecha estimada de parto
                    </label>

                    <input type="date"
                           id="estimated_birth_date"
                           name="estimated_birth_date"
                           value="{{ old('estimated_birth_date') }}"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('estimated_birth_date')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

            {{-- Resultado --}}
            <div class="border-t border-stone-100 pt-6">

                <h3 class="font-heading font-bold text-tierra-fertil mb-4">
                    Resultado del parto
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>

                        <label for="actual_birth_date"
                               class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                            Fecha real de parto
                        </label>

                        <input type="date"
                               id="actual_birth_date"
                               name="actual_birth_date"
                               value="{{ old('actual_birth_date') }}"
                               class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                        @error('actual_birth_date')
                            <span class="text-xs text-red-600 font-semibold">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div>

                        <label for="live_births"
                               class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                            Nacidos vivos
                        </label>

                        <input type="number"
                               id="live_births"
                               name="live_births"
                               value="{{ old('live_births', 0) }}"
                               min="0"
                               step="1"
                               required
                               class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                        @error('live_births')
                            <span class="text-xs text-red-600 font-semibold">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div>

                        <label for="stillbirths"
                               class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                            Mortinatos
                        </label>

                        <input type="number"
                               id="stillbirths"
                               name="stillbirths"
                               value="{{ old('stillbirths', 0) }}"
                               min="0"
                               step="1"
                               required
                               class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                        @error('stillbirths')
                            <span class="text-xs text-red-600 font-semibold">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>

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
                          maxlength="1000"
                          placeholder="Escribe cualquier observación importante..."
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
                            Gestación activa
                        </div>

                        <div class="text-xs text-stone-400">
                            Mantener este registro como proceso reproductivo activo.
                        </div>

                    </div>

                </label>

            </div>

            {{-- Botones --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-stone-100">

                <a href="{{ route('gestations.index') }}"
                   class="px-5 py-2.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm text-center">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold text-sm shadow-sm">
                    Guardar Gestación
                </button>

            </div>

        </form>

    </div>

</div>

@endsection