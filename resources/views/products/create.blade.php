@extends('layouts.app')

@section('title', 'Nuevo Producto')
@section('page_title', 'Agregar Insumo o Producto')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-6">

        <h2 class="text-2xl font-heading font-bold text-tierra-fertil">
            Agregar Insumo o Producto
        </h2>

        <p class="text-sm text-stone-500 mt-1">
            Registra un nuevo producto para una de tus fincas.
        </p>

    </div>

    <div class="bg-white p-8 rounded-xl shadow-sm border border-stone-200">

        <form action="{{ route('products.store') }}"
              method="POST"
              class="space-y-6">

            @csrf

            {{-- Finca --}}
            <div>

                <label for="farm_id"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Finca destino
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
                            No tienes fincas registradas
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
                        Debes registrar una finca antes de agregar productos.
                    </p>
                @endif

            </div>

            {{-- Nombre --}}
            <div>

                <label for="name"
                       class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                    Nombre del producto / insumo
                </label>

                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Ej: Concentrado Engorde Pro 20%"
                       required
                       class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                @error('name')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            {{-- Tipo y Unidad --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label for="type"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Tipo de insumo
                    </label>

                    <select id="type"
                            name="type"
                            required
                            class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">

                        <option value="Alimento" {{ old('type', 'Alimento') == 'Alimento' ? 'selected' : '' }}>
                            Alimento
                        </option>

                        <option value="Medicamento" {{ old('type') == 'Medicamento' ? 'selected' : '' }}>
                            Medicamento
                        </option>

                        <option value="Suplemento" {{ old('type') == 'Suplemento' ? 'selected' : '' }}>
                            Suplemento
                        </option>

                        <option value="Otro" {{ old('type') == 'Otro' ? 'selected' : '' }}>
                            Otro
                        </option>

                    </select>

                    @error('type')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div>

                    <label for="unit_measurement"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Unidad de medida
                    </label>

                    <input type="text"
                           id="unit_measurement"
                           name="unit_measurement"
                           value="{{ old('unit_measurement') }}"
                           placeholder="Ej: Kg, Bulto, Litro, Frasco"
                           maxlength="60"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('unit_measurement')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

            {{-- Stock --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label for="current_stock"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Stock actual
                    </label>

                    <input type="number"
                           id="current_stock"
                           name="current_stock"
                           value="{{ old('current_stock') }}"
                           min="0"
                           step="0.01"
                           placeholder="Ej: 50.00"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('current_stock')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div>

                    <label for="min_stock"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Stock mínimo
                    </label>

                    <input type="number"
                           id="min_stock"
                           name="min_stock"
                           value="{{ old('min_stock') }}"
                           min="0"
                           step="0.01"
                           placeholder="Ej: 10.00"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('min_stock')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

            {{-- Costos --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label for="unit_cost"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Costo por unidad
                    </label>

                    <div class="relative">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 text-sm">
                            C$
                        </span>

                        <input type="number"
                               id="unit_cost"
                               name="unit_cost"
                               value="{{ old('unit_cost') }}"
                               min="0"
                               step="0.01"
                               placeholder="0.00"
                               required
                               class="w-full border-stone-300 rounded-lg p-2.5 pl-9 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    </div>

                    @error('unit_cost')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div>

                    <label for="historical_average_price"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Precio promedio histórico
                    </label>

                    <div class="relative">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 text-sm">
                            C$
                        </span>

                        <input type="number"
                               id="historical_average_price"
                               name="historical_average_price"
                               value="{{ old('historical_average_price') }}"
                               min="0"
                               step="0.01"
                               placeholder="0.00"
                               required
                               class="w-full border-stone-300 rounded-lg p-2.5 pl-9 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    </div>

                    @error('historical_average_price')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

            {{-- Compra --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label for="last_purchase_date"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Fecha de última compra
                    </label>

                    <input type="date"
                           id="last_purchase_date"
                           name="last_purchase_date"
                           value="{{ old('last_purchase_date') }}"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('last_purchase_date')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div>

                    <label for="regular_supplier"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Proveedor habitual
                    </label>

                    <input type="text"
                           id="regular_supplier"
                           name="regular_supplier"
                           value="{{ old('regular_supplier') }}"
                           placeholder="Ej: Agropecuaria El Campo"
                           maxlength="255"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('regular_supplier')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

            {{-- Lote / Vencimiento --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label for="batch"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Número de lote
                    </label>

                    <input type="text"
                           id="batch"
                           name="batch"
                           value="{{ old('batch') }}"
                           placeholder="Ej: LOT-2026-001"
                           maxlength="255"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('batch')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

                <div>

                    <label for="expiration_date"
                           class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">
                        Fecha de vencimiento
                    </label>

                    <input type="date"
                           id="expiration_date"
                           name="expiration_date"
                           value="{{ old('expiration_date') }}"
                           required
                           class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">

                    @error('expiration_date')
                        <span class="text-xs text-red-600 font-semibold">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>

            {{-- Botones --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-stone-100">

                <a href="{{ route('products.index') }}"
                   class="px-5 py-2.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm text-center transition">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold text-sm shadow-sm transition">
                    Guardar Producto
                </button>

            </div>

        </form>

    </div>

</div>

@endsection