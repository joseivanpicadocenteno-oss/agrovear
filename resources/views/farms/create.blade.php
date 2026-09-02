@extends('layouts.app')

@section('title', 'Crear Finca')
@section('page_title', 'Registrar Nueva Finca')

@section('content')
<div class="max-w-2xl bg-white p-8 rounded-xl shadow-sm border border-stone-200">

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm">
            <p class="font-bold mb-1">Por favor corrige los errores:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('farms.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Nombre de la Finca *</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Departamento *</label>
                <input type="text" name="department" value="{{ old('department') }}" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
            </div>
            <div>
                <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Municipio *</label>
                <input type="text" name="municipality" value="{{ old('municipality') }}" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
            </div>
        </div>

        <div>
            <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Dirección / Comunidad</label>
            <input type="text" name="address" value="{{ old('address') }}" class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
        </div>

        <div>
            <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Teléfono *</label>
            <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">
        </div>

        <div>
            <label class="block font-heading font-semibold text-tierra-fertil text-sm mb-1">Descripción</label>
            <textarea name="description" rows="3" class="w-full border-stone-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-verde-natural outline-none text-sm">{{ old('description') }}</textarea>
        </div>

        <div class="flex items-center space-x-2 pt-2">
            <input type="checkbox" name="active" value="1" id="active" checked class="rounded text-verde-natural focus:ring-verde-natural h-4 w-4">
            <label for="active" class="text-sm font-semibold text-stone-700">Finca Activa</label>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t border-stone-100">
            <a href="{{ route('farms.index') }}" class="px-4 py-2 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm">Cancelar</a>
            <button type="submit" class="bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2 rounded-lg shadow-sm text-sm">Guardar Finca</button>
        </div>
    </form>
</div>
@endsection