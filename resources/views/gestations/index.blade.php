@extends('layouts.app')

@section('title', 'Gestaciones')
@section('page_title', 'Control de Gestaciones')

@section('content')

<div class="space-y-6">

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h2 class="text-2xl font-heading font-bold text-tierra-fertil">
                Control de Gestaciones
            </h2>

            <p class="text-sm text-stone-500 mt-1">
                Registra y controla los servicios, nacimientos y resultados reproductivos.
            </p>
        </div>

        <a href="{{ route('gestations.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2.5 rounded-lg shadow-sm transition">
            <span class="text-lg">+</span>
            Nueva Gestación
        </a>

    </div>

    <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden">

        @if($gestations->count())

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-stone-50 border-b border-stone-200">

                        <tr class="text-left">

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Animal
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Servicio
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Parto estimado
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Parto real
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Nacidos
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Estado
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil text-right">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-stone-100">

                        @foreach($gestations as $gestation)

                            <tr class="hover:bg-stone-50 transition">

                                <td class="px-5 py-4">

                                    <div class="font-semibold text-tierra-fertil">
                                        {{ $gestation->animal->name ?? 'Animal eliminado' }}
                                    </div>

                                    @if($gestation->animal?->farm)
                                        <div class="text-xs text-stone-400 mt-1">
                                            {{ $gestation->animal->farm->name }}
                                        </div>
                                    @endif

                                </td>

                                <td class="px-5 py-4 text-stone-600">
                                    {{ $gestation->service_date?->format('d/m/Y') ?? '—' }}
                                </td>

                                <td class="px-5 py-4 text-stone-600">
                                    {{ $gestation->estimated_birth_date?->format('d/m/Y') ?? '—' }}
                                </td>

                                <td class="px-5 py-4">

                                    @if($gestation->actual_birth_date)
                                        <span class="text-stone-600">
                                            {{ $gestation->actual_birth_date->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span class="text-stone-400">
                                            Pendiente
                                        </span>
                                    @endif

                                </td>

                                <td class="px-5 py-4">

                                    <div class="font-semibold text-green-700">
                                        {{ $gestation->live_births }}
                                    </div>

                                    @if($gestation->stillbirths > 0)
                                        <div class="text-xs text-red-500 mt-1">
                                            {{ $gestation->stillbirths }} mortinatos
                                        </div>
                                    @endif

                                </td>

                                <td class="px-5 py-4">

                                    @if($gestation->active)

                                        <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                            Activa
                                        </span>

                                    @else

                                        <span class="px-2.5 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                                            Finalizada
                                        </span>

                                    @endif

                                </td>

                                <td class="px-5 py-4">

                                    <div class="flex justify-end items-center gap-2">

                                        <a href="{{ route('gestations.show', $gestation) }}"
                                           class="px-3 py-1.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-100 text-xs font-semibold">
                                            Ver
                                        </a>

                                        <a href="{{ route('gestations.edit', $gestation) }}"
                                           class="px-3 py-1.5 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold">
                                            Editar
                                        </a>

                                        <form action="{{ route('gestations.destroy', $gestation) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Deseas eliminar este registro de gestación?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="px-3 py-1.5 rounded-lg bg-red-600 hover:bg-red-700 text-white text-xs font-semibold">
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="px-5 py-4 border-t border-stone-200">
                {{ $gestations->links() }}
            </div>

        @else

            <div class="px-6 py-16 text-center">

                <div class="text-5xl mb-4">
                    🐖
                </div>

                <h3 class="text-lg font-heading font-bold text-tierra-fertil">
                    No hay gestaciones registradas
                </h3>

                <p class="text-sm text-stone-500 mt-2 mb-6">
                    Registra el primer proceso reproductivo de una hembra.
                </p>

                <a href="{{ route('gestations.create') }}"
                   class="inline-flex items-center gap-2 bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2.5 rounded-lg">
                    + Registrar gestación
                </a>

            </div>

        @endif

    </div>

</div>

@endsection