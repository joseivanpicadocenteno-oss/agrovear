@extends('layouts.app')

@section('title', 'Mis Fincas')
@section('page_title', 'Gestión de Fincas')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-stone-600 text-sm">Listado de predios registrados bajo tu cuenta.</p>
    <a href="{{ route('farms.create') }}" class="bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-4 py-2 rounded-lg text-sm shadow-sm transition">
        + Nueva Finca
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-stone-100 border-b border-stone-200 font-heading text-xs font-bold text-tierra-fertil uppercase">
                <th class="p-4">Nombre</th>
                <th class="p-4">Ubicación</th>
                <th class="p-4">Teléfono</th>
                <th class="p-4">Estado</th>
                <th class="p-4 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-200 text-sm">
            @forelse($farms as $farm)
                <tr class="hover:bg-stone-50">
                    <td class="p-4 font-bold text-stone-800">
                        <a href="{{ route('farms.show', $farm) }}" class="hover:underline text-verde-natural">
                            {{ $farm->name }}
                        </a>
                    </td>
                    <td class="p-4 text-stone-600">{{ $farm->municipality }}, {{ $farm->department }}</td>
                    <td class="p-4 text-stone-600">{{ $farm->phone }}</td>
                    <td class="p-4">
                        @if($farm->active)
                            <span class="px-2.5 py-1 text-xs font-bold bg-green-100 text-green-700 rounded-full">Activa</span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-bold bg-stone-100 text-stone-600 rounded-full">Inactiva</span>
                        @endif
                    </td>
                    <td class="p-4 text-right space-x-2">
                        <a href="{{ route('farms.edit', $farm) }}" class="text-xs font-bold text-tierra-fertil hover:underline">Editar</a>
                        <form action="{{ route('farms.destroy', $farm) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta finca?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-bold text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-stone-500">No tienes fincas registradas aún.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection