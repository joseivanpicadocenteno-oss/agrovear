@extends('layouts.app')

@section('title', 'Nuevo Animal')
@section('page_title', 'Registrar Nuevo Animal')

@section('content')
<div class="max-w-2xl bg-white p-8 rounded-xl shadow-sm border border-stone-200">
    <form action="{{ route('animals.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Seleccionar Finca</label>
            <select name="farm_id" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">
                <option value="" disabled selected>-- Elige una finca --</option>
                @foreach($farms as $farm)
                    <option value="{{ $farm->id }}" {{ old('farm_id') == $farm->id ? 'selected' : '' }}>{{ $farm->name }}</option>
                @endforeach
            </select>
            @error('farm_id') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Nombre / Identificación</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Ej: Vaca 04 - Lucero" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
                @error('name') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Número de Chapa / Arete</label>
                <input type="text" name="tag_number" value="{{ old('tag_number') }}" placeholder="Ej: CH-9082" class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
                @error('tag_number') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Especie</label>
                <select name="species" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">
                    <option value="Bovino">Bovino</option>
                    <option value="Porcino">Porcino</option>
                    <option value="Ovino">Ovino</option>
                    <option value="Caprino">Caprino</option>
                </select>
                @error('species') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Sexo</label>
                <select name="sex" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm bg-white">
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>
                @error('sex') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Peso (kg)</label>
                <input type="number" step="0.01" name="weight" value="{{ old('weight') }}" placeholder="Ej: 450.5" class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
                @error('weight') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-stone-100">
            <a href="{{ route('animals.index') }}" class="px-4 py-2 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm">Cancelar</a>
            <button type="submit" class="bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2 rounded-lg shadow-sm text-sm">Guardar Animal</button>
        </div>
    </form>
</div>
@endsection