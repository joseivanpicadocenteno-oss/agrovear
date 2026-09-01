@extends('layouts.app')

@section('title', 'Nuevo Producto')
@section('page_title', 'Agregar Insumo o Producto')

@section('content')
<div class="max-w-2xl bg-white p-8 rounded-xl shadow-sm border border-stone-200">
    <form action="{{ route('products.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Finca Destino</label>
            <select name="farm_id" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">
                <option value="" disabled selected>-- Selecciona la finca --</option>
                @foreach($farms as $farm)
                    <option value="{{ $farm->id }}" {{ old('farm_id') == $farm->id ? 'selected' : '' }}>{{ $farm->name }}</option>
                @endforeach
            </select>
            @error('farm_id') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Nombre del Producto / Insumo</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Ej: Concentrado Engorde Pro 20%" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
            @error('name') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Tipo de Insumo</label>
                <select name="type" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">
                    <option value="Alimento">Alimento</option>
                    <option value="Medicamento">Medicamento</option>
                    <option value="Suplemento">Suplemento</option>
                    <option value="Otro">Otro</option>
                </select>
                @error('type') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Cantidad Inicial</label>
                <input type="number" step="0.01" name="quantity" value="{{ old('quantity') }}" placeholder="Ej: 50" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
                @error('quantity') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Unidad de Medida</label>
                <input type="text" name="unit" value="{{ old('unit') }}" placeholder="Ej: Kg, Bulto, Litro" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
                @error('unit') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-stone-100">
            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm">Cancelar</a>
            <button type="submit" class="bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2 rounded-lg shadow-sm text-sm">Guardar Producto</button>
        </div>
    </form>
</div>
@endsection