@extends('layouts.app')

@section('title', $animal->name)
@section('page_title', 'Ficha del Animal')

@section('content')

<div class="space-y-6">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-stone-500">
        <a href="{{ route('animals.index') }}" class="hover:text-verde-natural">
            Animales
        </a>

        <span>/</span>

        <span>{{ $animal->name }}</span>
    </div>


    {{-- Encabezado principal --}}
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">

        <div class="bg-gradient-to-r from-green-50 via-white to-amber-50 p-6 md:p-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 rounded-2xl bg-verde-natural text-white flex items-center justify-center font-heading text-2xl font-bold shadow-sm">
                        {{ strtoupper(substr($animal->name, 0, 1)) }}
                    </div>

                    <div>
                        <div class="flex flex-wrap items-center gap-2">

                            <h1 class="font-heading text-2xl font-bold text-tierra-fertil">
                                {{ $animal->name }}
                            </h1>

                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold
                                {{ $animal->active
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-stone-100 text-stone-600' }}"
                            >
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                    {{ $animal->active ? 'bg-green-500' : 'bg-stone-400' }}">
                                </span>

                                {{ $animal->active ? 'Activo' : 'Inactivo' }}
                            </span>

                        </div>

                        <p class="text-sm text-stone-500 mt-1">
                            {{ $animal->breed }} · {{ $animal->species }} · {{ $animal->sex }}
                        </p>

                        <p class="text-xs text-stone-400 mt-1">
                            Finca: {{ $animal->farm->name ?? 'Sin finca' }}
                        </p>
                    </div>

                </div>

                <div class="flex flex-wrap gap-2">

                    <a
                        href="{{ route('animals.edit', $animal) }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-stone-300 text-sm font-bold text-stone-700 hover:bg-stone-50 transition"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>

                        Editar
                    </a>

                    <form
                        action="{{ route('animals.destroy', $animal) }}"
                        method="POST"
                        onsubmit="return confirm('¿Estás seguro de eliminar este animal? Esta acción no se puede deshacer.');"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-red-200 text-sm font-bold text-red-600 hover:bg-red-50 transition"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8"/>
                            </svg>

                            Eliminar
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>


    {{-- KPIs --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white border border-stone-200 rounded-2xl p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-stone-400">
                Edad
            </p>

            <p class="font-heading text-2xl font-bold text-tierra-fertil mt-2">
                @if($animal->birth_date)
                    {{ $animal->age_in_months }}
                    <span class="text-sm font-semibold text-stone-400">meses</span>
                @else
                    —
                @endif
            </p>
        </div>

        <div class="bg-white border border-stone-200 rounded-2xl p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-stone-400">
                Peso actual
            </p>

            <p class="font-heading text-2xl font-bold text-tierra-fertil mt-2">
                {{ number_format((float) $animal->weight_kg, 2) }}
                <span class="text-sm font-semibold text-stone-400">kg</span>
            </p>
        </div>

        <div class="bg-white border border-stone-200 rounded-2xl p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-stone-400">
                Peso objetivo
            </p>

            <p class="font-heading text-2xl font-bold text-tierra-fertil mt-2">
                @if($animal->target_weight)
                    {{ number_format((float) $animal->target_weight, 2) }}
                    <span class="text-sm font-semibold text-stone-400">kg</span>
                @else
                    —
                @endif
            </p>
        </div>

        <div class="bg-white border border-stone-200 rounded-2xl p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-stone-400">
                Progreso
            </p>

            @if($animal->target_weight)
                <p class="font-heading text-2xl font-bold text-verde-natural mt-2">
                    {{ number_format($animal->weight_progress, 0) }}%
                </p>

                <div class="mt-2 w-full bg-stone-100 rounded-full h-2 overflow-hidden">
                    <div
                        class="bg-verde-natural h-2 rounded-full"
                        style="width: {{ $animal->weight_progress }}%"
                    ></div>
                </div>
            @else
                <p class="font-heading text-2xl font-bold text-stone-400 mt-2">
                    —
                </p>
            @endif
        </div>
    </div>


    {{-- Información general + valor --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2 bg-white border border-stone-200 rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="font-heading font-bold text-lg text-tierra-fertil">
                        Información general
                    </h2>

                    <p class="text-xs text-stone-500 mt-1">
                        Datos principales registrados.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-8">

                <div>
                    <p class="text-xs text-stone-400">Finca</p>
                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $animal->farm->name ?? 'Sin finca' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-stone-400">Especie</p>
                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $animal->species }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-stone-400">Raza</p>
                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $animal->breed }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-stone-400">Sexo</p>
                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $animal->sex }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-stone-400">Fecha de nacimiento</p>
                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $animal->birth_date?->format('d/m/Y') ?? 'No registrada' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-stone-400">Última pesada</p>
                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $animal->last_weighing?->format('d/m/Y') ?? 'No registrada' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-stone-400">Estado reproductivo</p>
                    <p class="text-sm font-semibold text-stone-700 mt-1">
                        {{ $animal->reproductive_status ?: 'No registrado' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-stone-400">Estado</p>
                    <p class="text-sm font-semibold mt-1 {{ $animal->active ? 'text-green-700' : 'text-stone-500' }}">
                        {{ $animal->active ? 'Activo' : 'Inactivo' }}
                    </p>
                </div>

            </div>
        </div>


        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm p-6">

            <h2 class="font-heading font-bold text-lg text-tierra-fertil">
                Información económica
            </h2>

            <div class="space-y-5 mt-5">

                <div>
                    <p class="text-xs text-stone-400">
                        Precio de compra
                    </p>

                    <p class="font-heading font-bold text-xl text-stone-700 mt-1">
                        C$
                        {{ $animal->purchase_price !== null
                            ? number_format((float) $animal->purchase_price, 2)
                            : '—' }}
                    </p>
                </div>

                <div class="border-t border-stone-100 pt-5">
                    <p class="text-xs text-stone-400">
                        Valor estimado actual
                    </p>

                    <p class="font-heading font-bold text-xl text-verde-natural mt-1">
                        C$
                        {{ $animal->estimated_price !== null
                            ? number_format((float) $animal->estimated_price, 2)
                            : '—' }}
                    </p>
                </div>

            </div>
        </div>

    </div>


    {{-- Actividad --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Tratamientos --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="p-5 border-b border-stone-100 flex items-center justify-between">
                <div>
                    <h2 class="font-heading font-bold text-base text-tierra-fertil">
                        Tratamientos
                    </h2>

                    <p class="text-xs text-stone-500 mt-1">
                        Historial veterinario.
                    </p>
                </div>

                <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center text-xs font-bold">
                    {{ $animal->treatments->count() }}
                </span>
            </div>

            <div class="p-5">

                @forelse($animal->treatments->take(4) as $treatment)

                    <div class="py-3 first:pt-0 border-b last:border-0 border-stone-100">

                        <div class="flex items-start justify-between gap-3">

                            <div>
                                <p class="text-sm font-semibold text-stone-700">
                                    {{ $treatment->name ?: 'Tratamiento' }}
                                </p>

                                <p class="text-xs text-stone-400 mt-1">
                                    {{ $treatment->start_date?->format('d/m/Y') ?? 'Sin fecha' }}
                                </p>
                            </div>

                            <span class="text-[11px] px-2 py-1 rounded-full font-bold
                                {{ $treatment->active
                                    ? 'bg-blue-100 text-blue-700'
                                    : 'bg-stone-100 text-stone-500' }}"
                            >
                                {{ $treatment->active ? 'Activo' : 'Finalizado' }}
                            </span>

                        </div>

                        @if($treatment->diagnosis)
                            <p class="text-xs text-stone-500 mt-2">
                                {{ $treatment->diagnosis }}
                            </p>
                        @endif

                    </div>

                @empty

                    <p class="text-sm text-stone-400 text-center py-6">
                        No hay tratamientos registrados.
                    </p>

                @endforelse

                <a
                    href="{{ route('treatments.index') }}"
                    class="block text-center text-xs font-bold text-verde-natural mt-4 hover:underline"
                >
                    Ver tratamientos
                </a>

            </div>
        </div>


        {{-- Alimentación --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="p-5 border-b border-stone-100 flex items-center justify-between">

                <div>
                    <h2 class="font-heading font-bold text-base text-tierra-fertil">
                        Alimentación
                    </h2>

                    <p class="text-xs text-stone-500 mt-1">
                        Registros recientes.
                    </p>
                </div>

                <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center text-xs font-bold">
                    {{ $animal->feedingRecords->count() }}
                </span>
            </div>

            <div class="p-5">

                @forelse($animal->feedingRecords->take(4) as $feeding)

                    <div class="py-3 first:pt-0 border-b last:border-0 border-stone-100">

                        <div class="flex items-start justify-between gap-3">

                            <div>
                                <p class="text-sm font-semibold text-stone-700">
                                    {{ $feeding->recipe->name ?? 'Alimentación registrada' }}
                                </p>

                                <p class="text-xs text-stone-400 mt-1">
                                    {{ $feeding->feeding_date?->format('d/m/Y') ?? 'Sin fecha' }}
                                </p>
                            </div>

                            @if($feeding->amount_served !== null)
                                <span class="text-xs font-bold text-stone-600">
                                    {{ $feeding->amount_served }}
                                </span>
                            @endif

                        </div>

                    </div>

                @empty

                    <p class="text-sm text-stone-400 text-center py-6">
                        No hay registros de alimentación.
                    </p>

                @endforelse

                <a
                    href="{{ route('feedings.index') }}"
                    class="block text-center text-xs font-bold text-verde-natural mt-4 hover:underline"
                >
                    Ver alimentación
                </a>

            </div>
        </div>


        {{-- Gestaciones --}}
        <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="p-5 border-b border-stone-100 flex items-center justify-between">

                <div>
                    <h2 class="font-heading font-bold text-base text-tierra-fertil">
                        Reproducción
                    </h2>

                    <p class="text-xs text-stone-500 mt-1">
                        Historial reproductivo.
                    </p>
                </div>

                <span class="w-8 h-8 rounded-lg bg-purple-50 text-purple-700 flex items-center justify-center text-xs font-bold">
                    {{ $animal->gestationRecords->count() }}
                </span>
            </div>

            <div class="p-5">

                @forelse($animal->gestationRecords->take(4) as $gestation)

                    <div class="py-3 first:pt-0 border-b last:border-0 border-stone-100">

                        <p class="text-sm font-semibold text-stone-700">
                            Servicio
                        </p>

                        <p class="text-xs text-stone-400 mt-1">
                            {{ $gestation->service_date?->format('d/m/Y') ?? 'Sin fecha' }}
                        </p>

                        @if($gestation->estimated_birth_date)
                            <p class="text-xs text-purple-600 mt-2">
                                Parto estimado:
                                {{ $gestation->estimated_birth_date->format('d/m/Y') }}
                            </p>
                        @endif

                    </div>

                @empty

                    <p class="text-sm text-stone-400 text-center py-6">
                        No hay registros reproductivos.
                    </p>

                @endforelse

                <a
                    href="{{ route('gestations.index') }}"
                    class="block text-center text-xs font-bold text-verde-natural mt-4 hover:underline"
                >
                    Ver gestaciones
                </a>

            </div>
        </div>

    </div>


    {{-- Acciones relacionadas --}}
    <div class="bg-tierra-fertil rounded-2xl p-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h2 class="font-heading font-bold text-white">
                    Gestionar {{ $animal->name }}
                </h2>

                <p class="text-sm text-stone-300 mt-1">
                    Continúa registrando la actividad de este animal.
                </p>
            </div>

            <div class="flex flex-wrap gap-2">

                <a
                    href="{{ route('feedings.create') }}"
                    class="px-4 py-2.5 rounded-xl bg-white text-tierra-fertil text-xs font-bold hover:bg-stone-100"
                >
                    Registrar alimentación
                </a>

                <a
                    href="{{ route('treatments.create') }}"
                    class="px-4 py-2.5 rounded-xl bg-white text-tierra-fertil text-xs font-bold hover:bg-stone-100"
                >
                    Registrar tratamiento
                </a>

                @if($animal->sex === 'Hembra')
                    <a
                        href="{{ route('gestations.create') }}"
                        class="px-4 py-2.5 rounded-xl bg-secondary text-white text-xs font-bold hover:opacity-90"
                    >
                        Registrar gestación
                    </a>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection