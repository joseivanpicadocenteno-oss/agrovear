@php
        $isEdit = isset($animal);

        $speciesOptions = [
            'Bovino',
            'Porcino',
            'Ovino',
            'Caprino',
        ];

        $sexOptions = [
            'Macho',
            'Hembra',
        ];

        $reproductiveOptions = [
            'No aplica',
            'Sin determinar',
            'Reproductor',
            'En celo',
            'Gestante',
            'Lactando',
            'Descanso reproductivo',
        ];

        $currentReproductiveStatus = old(
            'reproductive_status',
            $animal->reproductive_status ?? 'Sin determinar'
        );
    @endphp

    <form
        action="{{ $isEdit ? route('animals.update', $animal) : route('animals.store') }}"
        method="POST"
        class="space-y-8"
    >
    @csrf

    @if($isEdit)
        @method('PUT')
    @endif

    {{-- Información básica --}}
    <section>
        <div class="flex items-center gap-3 mb-5">
            <div class="w-10 h-10 rounded-xl bg-green-100 text-verde-natural flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>

            <div>
                <h2 class="font-heading font-bold text-tierra-fertil text-base">
                    Información básica
                </h2>
                <p class="text-xs text-stone-500">
                    Identificación y clasificación del animal.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Finca --}}
            <div class="md:col-span-2">
                <label for="farm_id"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Finca <span class="text-red-500">*</span>
                </label>

                <select
                    id="farm_id"
                    name="farm_id"
                    required
                    class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >
                    <option value="">Selecciona una finca</option>

                    @foreach($farms as $farm)
                        <option
                            value="{{ $farm->id }}"
                            @selected(old('farm_id', $animal->farm_id ?? '') == $farm->id)
                        >
                            {{ $farm->name }}
                        </option>
                    @endforeach
                </select>

                @error('farm_id')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nombre --}}
            <div>
                <label for="name"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Nombre / Identificación <span class="text-red-500">*</span>
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $animal->name ?? '') }}"
                    placeholder="Ej. Lucero"
                    required
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

                @error('name')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Raza --}}
            <div>
                <label for="breed"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Raza <span class="text-red-500">*</span>
                </label>

                <input
                    id="breed"
                    type="text"
                    name="breed"
                    value="{{ old('breed', $animal->breed ?? '') }}"
                    placeholder="Ej. Brahman"
                    required
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

                @error('breed')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Especie --}}
            <div>
                <label for="species"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Especie <span class="text-red-500">*</span>
                </label>

                <select
                    id="species"
                    name="species"
                    required
                    class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >
                    @foreach($speciesOptions as $species)
                        <option
                            value="{{ $species }}"
                            @selected(old('species', $animal->species ?? 'Bovino') === $species)
                        >
                            {{ $species }}
                        </option>
                    @endforeach
                </select>

                @error('species')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sexo --}}
            <div>
                <label for="sex"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Sexo <span class="text-red-500">*</span>
                </label>

                <select
                    id="sex"
                    name="sex"
                    required
                    class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >
                    @foreach($sexOptions as $sex)
                        <option
                            value="{{ $sex }}"
                            @selected(old('sex', $animal->sex ?? 'Hembra') === $sex)
                        >
                            {{ $sex }}
                        </option>
                    @endforeach
                </select>

                @error('sex')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </section>


    {{-- Información física --}}
    <section class="border-t border-stone-100 pt-7">

        <div class="flex items-center gap-3 mb-5">
            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 6h18M6 6v12m12-12v12M4 18h16M9 10h6M9 14h6"/>
                </svg>
            </div>

            <div>
                <h2 class="font-heading font-bold text-tierra-fertil text-base">
                    Información física
                </h2>
                <p class="text-xs text-stone-500">
                    Peso y seguimiento del crecimiento.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Fecha nacimiento --}}
            <div>
                <label for="birth_date"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Fecha de nacimiento
                </label>

                <input
                    id="birth_date"
                    type="date"
                    name="birth_date"
                    value="{{ old('birth_date', isset($animal) && $animal->birth_date ? $animal->birth_date->format('Y-m-d') : '') }}"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

                @error('birth_date')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Peso actual --}}
            <div>
                <label for="weight_kg"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Peso actual <span class="text-red-500">*</span>
                </label>

                <div class="relative">
                    <input
                        id="weight_kg"
                        type="number"
                        name="weight_kg"
                        value="{{ old('weight_kg', $animal->weight_kg ?? '') }}"
                        min="0"
                        step="0.01"
                        placeholder="450.50"
                        required
                        class="w-full rounded-xl border border-stone-300 px-4 py-3 pr-14 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                    >

                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-stone-400">
                        KG
                    </span>
                </div>

                @error('weight_kg')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Peso objetivo --}}
            <div>
                <label for="target_weight"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Peso objetivo
                </label>

                <div class="relative">
                    <input
                        id="target_weight"
                        type="number"
                        name="target_weight"
                        value="{{ old('target_weight', $animal->target_weight ?? '') }}"
                        min="0"
                        step="0.01"
                        placeholder="600.00"
                        class="w-full rounded-xl border border-stone-300 px-4 py-3 pr-14 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                    >

                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-stone-400">
                        KG
                    </span>
                </div>

                @error('target_weight')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Última pesada --}}
            <div>
                <label for="last_weighing"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Fecha de última pesada
                </label>

                <input
                    id="last_weighing"
                    type="date"
                    name="last_weighing"
                    value="{{ old('last_weighing', isset($animal) && $animal->last_weighing ? $animal->last_weighing->format('Y-m-d') : '') }}"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

                @error('last_weighing')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </section>


    {{-- Reproducción --}}
    <section class="border-t border-stone-100 pt-7">

        <div class="flex items-center gap-3 mb-5">
            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 21a9 9 0 100-18 9 9 0 000 18zM8 12h8M12 8v8"/>
                </svg>
            </div>

            <div>
                <h2 class="font-heading font-bold text-tierra-fertil text-base">
                    Estado reproductivo
                </h2>

                <p class="text-xs text-stone-500">
                    Información útil para seguimiento reproductivo.
                </p>
            </div>
        </div>

        @if($currentReproductiveStatus && !in_array($currentReproductiveStatus, $reproductiveOptions))
            <select
                name="reproductive_status"
                class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
            >
                <option value="{{ $currentReproductiveStatus }}" selected>
                    {{ $currentReproductiveStatus }}
                </option>

                @foreach($reproductiveOptions as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        @else
            <select
                name="reproductive_status"
                required
                class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
            >
                @foreach($reproductiveOptions as $status)
                    <option
                        value="{{ $status }}"
                        @selected($currentReproductiveStatus === $status)
                    >
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        @endif

        @error('reproductive_status')
            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
        @enderror
    </section>


    {{-- Información económica --}}
    <section class="border-t border-stone-100 pt-7">

        <div class="flex items-center gap-3 mb-5">
            <div class="w-10 h-10 rounded-xl bg-yellow-100 text-yellow-700 flex items-center justify-center">
                <span class="font-bold text-sm">C$</span>
            </div>

            <div>
                <h2 class="font-heading font-bold text-tierra-fertil text-base">
                    Valor económico
                </h2>

                <p class="text-xs text-stone-500">
                    Control financiero individual del animal.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label for="purchase_price"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Precio de compra
                </label>

                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-stone-400">
                        C$
                    </span>

                    <input
                        id="purchase_price"
                        type="number"
                        name="purchase_price"
                        value="{{ old('purchase_price', $animal->purchase_price ?? '') }}"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        class="w-full rounded-xl border border-stone-300 pl-11 pr-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                    >
                </div>

                @error('purchase_price')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="estimated_price"
                       class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Valor estimado actual
                </label>

                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-stone-400">
                        C$
                    </span>

                    <input
                        id="estimated_price"
                        type="number"
                        name="estimated_price"
                        value="{{ old('estimated_price', $animal->estimated_price ?? '') }}"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        class="w-full rounded-xl border border-stone-300 pl-11 pr-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                    >
                </div>

                @error('estimated_price')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </section>


    {{-- Estado --}}
    <section class="border-t border-stone-100 pt-7">

        <div class="rounded-xl border border-stone-200 bg-stone-50 px-4 py-4 flex items-center justify-between gap-4">

            <div>
                <p class="font-semibold text-sm text-tierra-fertil">
                    Animal activo
                </p>

                <p class="text-xs text-stone-500 mt-0.5">
                    Los animales inactivos permanecerán en el historial.
                </p>
            </div>

            <label class="relative inline-flex items-center cursor-pointer">
                <input
                    type="hidden"
                    name="active"
                    value="0"
                >

                <input
                    type="checkbox"
                    name="active"
                    value="1"
                    class="sr-only peer"
                    @checked(old('active', $animal->active ?? true))
                >

                <div class="w-11 h-6 bg-stone-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-100 rounded-full peer peer-checked:bg-verde-natural after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-stone-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
            </label>
        </div>
    </section>


    {{-- Botones --}}
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-stone-100 pt-6">

        <button
            type="submit"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-verde-natural text-white font-heading font-bold text-sm shadow-sm hover:opacity-90 transition"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 13l4 4L19 7"/>
            </svg>

            {{ $isEdit ? 'Guardar cambios' : 'Registrar animal' }}
        </button>

        <a
            href="{{ $isEdit ? route('animals.show', $animal) : route('animals.index') }}"
            class="w-full sm:w-auto text-center px-5 py-3 rounded-xl border border-stone-300 text-stone-600 font-semibold text-sm hover:bg-stone-50 transition"
        >
            Cancelar
        </a>

    </div>
</form>