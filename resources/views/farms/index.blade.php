@extends('layouts.app')

@section('title', 'Mis Fincas')
@section('page_title', 'Listado de Fincas')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <div>
        <p class="text-stone-600 text-sm">
            Gestiona los predios registrados bajo tu cuenta.
        </p>
    </div>

    <div class="flex items-center gap-3">

        {{-- Volver al Dashboard --}}
        <a
            href="{{ route('dashboard') }}"
            class="inline-flex items-center gap-2
                   px-4 py-2 rounded-lg
                   border border-stone-300
                   bg-white
                   text-[#603813]
                   text-sm font-semibold
                   hover:bg-stone-50
                   transition"
        >
            <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m7 7H3"
                />
            </svg>

            Dashboard
        </a>

        {{-- Nueva finca --}}
        <a
            href="{{ route('farms.create') }}"
            class="inline-flex items-center gap-2
                   px-4 py-2 rounded-lg
                   bg-[#397C0E]
                   text-white
                   text-sm font-bold
                   shadow-sm
                   hover:bg-[#2f680b]
                   transition"
        >
            + Nueva Finca
        </a>

    </div>

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
                <tr class="hover:bg-stone-50 transition">
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
                        <form action="{{ route('farms.destroy', $farm) }}" method="POST" class="inline" onsubmit="return confirm('¿Deseas eliminar esta finca?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-bold text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-stone-500">
                        No tienes fincas registradas aún. <a href="{{ route('farms.create') }}" class="text-verde-natural font-bold underline">Crea la primera aquí</a>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $farms->links() }}
</div>
@endsection