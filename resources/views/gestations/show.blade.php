@extends('layouts.app')

@section('title', 'Gestación')
@section('page_title', 'Ficha de Gestación')

@section('content')

<div class="space-y-6">

    @php
        $diasRestantes = null;

        if ($gestation->estimated_birth_date && !$gestation->actual_birth_date) {
            $diasRestantes = now()->startOfDay()
                ->diffInDays($gestation->estimated_birth_date->startOfDay(), false);
        }
    @endphp

    {{-- Encabezado --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 text-sm text-stone-500 mb-2">

                <a href="{{ route('gestations.index') }}"
                   class="hover:text-verde-natural">
                    Gestaciones
                </a>

                <span>/</span>

                <span>Registro #{{ $gestation->id }}</span>

            </div>

            <div class="flex flex-wrap items-center gap-3">

                <h1 class="text-3xl font-heading font-bold text-tierra-fertil">
                    Gestación de {{ $gestation->animal->name ?? 'Animal' }}
                </h1>

                @if($gestation->active)

                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                        Activa
                    </span>

                @else

                    <span class="px-3 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                        Finalizada
                    </span>

                @endif

            </div>

            <p class="text-stone-500 mt-2">
                {{ $gestation->animal->farm->name ?? 'Sin finca' }}
            </p>

        </div>

        <div class="flex flex-wrap gap-2">

            <a href="{{ route('gestations.index') }}"
               class="px-4 py-2 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm">
                ← Gestaciones
            </a>

            <a href="{{ route('gestations.edit', $gestation) }}"
               class="px-4 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white font-semibold text-sm">
                Editar
            </a>

            <form action="{{ route('gestations.destroy', $gestation) }}"
                  method="POST"
                  onsubmit="return confirm('¿Deseas eliminar este registro de gestación?');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold text-sm">
                    Eliminar
                </button>

            </form>

        </div>

    </div>

    {{-- Resumen --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Fecha de servicio
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ $gestation->service_date?->format('d/m/Y') ?? '—' }}
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Parto estimado
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ $gestation->estimated_birth_date?->format('d/m/Y') ?? '—' }}
            </p>

            @if($diasRestantes !== null)

                @if($diasRestantes > 0)

                    <p class="text-xs text-green-600 font-semibold mt-1">
                        {{ $diasRestantes }} días restantes
                    </p>

                @elseif($diasRestantes === 0)

                    <p class="text-xs text-yellow-600 font-semibold mt-1">
                        Fecha estimada hoy
                    </p>

                @else

                    <p class="text-xs text-red-600 font-semibold mt-1">
                        Fecha estimada superada
                    </p>

                @endif

            @endif

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Nacidos vivos
            </p>

            <p class="text-2xl font-heading font-bold text-green-700 mt-2">
                {{ $gestation->live_births }}
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Mortinatos
            </p>

            <p class="text-2xl font-heading font-bold {{ $gestation->stillbirths > 0 ? 'text-red-600' : 'text-tierra-fertil' }} mt-2">
                {{ $gestation->stillbirths }}
            </p>

        </div>

    </div>

    {{-- Información --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-xl shadow-sm border border-stone-200">

            <div class="px-6 py-4 border-b border-stone-100">

                <h2 class="font-heading font-bold text-tierra-fertil">
                    Información reproductiva
                </h2>

            </div>

            <div class="p-6 space-y-4">

                <div class="flex justify-between gap-4">

                    <span class="text-sm text-stone-500">
                        Animal
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        {{ $gestation->animal->name ?? '—' }}
                    </span>

                </div>

                <div class="flex justify-between gap-4">

                    <span class="text-sm text-stone-500">
                        Finca
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        {{ $gestation->animal->farm->name ?? '—' }}
                    </span>

                </div>

                <div class="flex justify-between gap-4">

                    <span class="text-sm text-stone-500">
                        Fecha de servicio
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        {{ $gestation->service_date?->format('d/m/Y') ?? '—' }}
                    </span>

                </div>

                <div class="flex justify-between gap-4">

                    <span class="text-sm text-stone-500">
                        Parto estimado
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        {{ $gestation->estimated_birth_date?->format('d/m/Y') ?? '—' }}
                    </span>

                </div>

                <div class="flex justify-between gap-4">

                    <span class="text-sm text-stone-500">
                        Parto real
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        {{ $gestation->actual_birth_date?->format('d/m/Y') ?? 'Pendiente' }}
                    </span>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-xl shadow-sm border border-stone-200">

            <div class="px-6 py-4 border-b border-stone-100">

                <h2 class="font-heading font-bold text-tierra-fertil">
                    Resultado
                </h2>

            </div>

            <div class="p-6">

                <div class="grid grid-cols-2 gap-4">

                    <div class="rounded-lg bg-green-50 p-4">

                        <p class="text-xs text-green-600 font-bold uppercase">
                            Nacidos vivos
                        </p>

                        <p class="text-2xl font-heading font-bold text-green-700 mt-1">
                            {{ $gestation->live_births }}
                        </p>

                    </div>

                    <div class="rounded-lg bg-red-50 p-4">

                        <p class="text-xs text-red-600 font-bold uppercase">
                            Mortinatos
                        </p>

                        <p class="text-2xl font-heading font-bold text-red-700 mt-1">
                            {{ $gestation->stillbirths }}
                        </p>

                    </div>

                </div>

                @if($gestation->observations)

                    <div class="mt-5 pt-5 border-t border-stone-100">

                        <p class="text-xs uppercase font-bold text-stone-400">
                            Observaciones
                        </p>

                        <p class="text-sm text-stone-700 mt-2">
                            {{ $gestation->observations }}
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

    {{-- Alimentación asociada --}}
    <div class="bg-white rounded-xl shadow-sm border border-stone-200">

        <div class="px-6 py-4 border-b border-stone-100">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="font-heading font-bold text-tierra-fertil">
                        Alimentación durante la gestación
                    </h2>

                    <p class="text-xs text-stone-500 mt-1">
                        Registros de alimentación asociados a este proceso.
                    </p>

                </div>

                <span class="px-2.5 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                    {{ $gestation->feedingRecords->count() }}
                </span>

            </div>

        </div>

        <div class="p-6">

            @if($gestation->feedingRecords->count())

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead>

                            <tr class="border-b border-stone-100 text-left">

                                <th class="py-3 pr-4 text-xs uppercase text-stone-400">
                                    Fecha
                                </th>

                                <th class="py-3 pr-4 text-xs uppercase text-stone-400">
                                    Receta
                                </th>

                                <th class="py-3 text-xs uppercase text-stone-400">
                                    Cantidad
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($gestation->feedingRecords as $feeding)

                                <tr class="border-b border-stone-50">

                                    <td class="py-3 pr-4 text-stone-600">
                                        {{ $feeding->feeding_date?->format('d/m/Y') ?? '—' }}
                                    </td>

                                    <td class="py-3 pr-4 font-semibold text-stone-700">
                                        {{ $feeding->recipe->name ?? '—' }}
                                    </td>

                                    <td class="py-3 text-stone-600">
                                        {{ number_format((float) $feeding->amount_served, 2) }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <p class="text-sm text-stone-500">
                    No existen registros de alimentación relacionados con esta gestación.
                </p>

            @endif

        </div>

    </div>

</div>

@endsection