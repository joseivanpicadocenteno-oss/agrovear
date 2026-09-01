@extends('layouts.app')

@section('title', 'Editar Finca')
@section('page_title', 'Editar Finca')

@section('content')
<div class="max-w-2xl bg-white p-8 rounded-xl shadow-sm border border-stone-200">
    <form action="{{ route('farms.update', $farm) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Nombre de la Finca</label>
            <input type="text" name="name" value="{{ old('name', $farm->name) }}" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
            @error('name') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Departamento</label>
                <input type="text" name="department" value="{{ old('department', $farm->department) }}" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
                @error('department') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Municipio</label>
                <input type="text" name="municipality" value="{{ old('municipality', $farm->municipality) }}" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
                @error('municipality') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Teléfono de Contacto</label>
            <input type="text" name="phone" value="{{ old('phone', $farm->phone) }}" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
            @error('phone') <span class="text-xs text-red-600 font-semibold">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center space-x-2 pt-2">
            <input type="checkbox" name="active" value="1" id="active" {{ $farm->active ? 'checked' : '' }} class="rounded text-verde-natural focus:ring-verde-natural h-4 w-4">
            <label for="active" class="text-sm font-semibold text-stone-700">Finca Activa</label>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-stone-100">
            <a href="{{ route('farms.index') }}" class="px-4 py-2 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm">Cancelar</a>
            <button type="submit" class="bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2 rounded-lg shadow-sm text-sm">Actualizar Finca</button>
        </div>
    </form>
</div>
@endsection