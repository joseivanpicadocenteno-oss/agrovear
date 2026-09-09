@extends('layouts.app')

@section('title', 'Tratamiento')
@section('page_title', 'Ficha de Tratamiento')

@section('content')

<div class="space-y-6">

    @php
        $now = now();
        $finalizado = $treatment->end_date && $treatment->end_date->isPast();
    @endphp

    {{-- Encabezado --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 text-sm text-stone-500 mb-2">

                <a href="{{ route('treatments.index') }}"
                   class="hover:text-verde-natural">
                    Tratamientos
                </a>

                <span>/</span>

                <span>{{ $treatment->name }}</span>

            </div>

            <div class="flex flex-wrap items-center gap-3">

                <h1 class="text-3xl font-heading font-bold text-tierra-fertil">
                    {{ $treatment->name }}
                </h1>

                @if($treatment->active)

                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                        Activo
                    </span>

                @else

                    <span class="px-3 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                        Finalizado
                    </span>

                @endif

            </div>

            <p class="text-stone-500 mt-2">
                {{ $treatment->animal->name ?? 'Animal' }}
                ·
                {{ $treatment->animal->farm->name ?? 'Sin finca' }}
            </p>

        </div>

        <div class="flex flex-wrap gap-2">

            <a href="{{ route('treatments.index') }}"
               class="px-4 py-2 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm">
                ← Tratamientos
            </a>

            <a href="{{ route('treatments.edit', $treatment) }}"
               class="px-4 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white font-semibold text-sm">
                Editar
            </a>

            <form action="{{ route('treatments.destroy', $treatment) }}"
                  method="POST"
                  onsubmit="return confirm('¿Deseas eliminar este tratamiento?');">

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
                Animal
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ $treatment->animal->name ?? '—' }}
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Inicio
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ $treatment->start_date?->format('d/m/Y') ?? '—' }}
            </p>

            <p class="text-xs text-stone-400 mt-1">
                {{ $treatment->start_date?->format('H:i') ?? '' }}
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Finalización
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ $treatment->end_date?->format('d/m/Y') ?? '—' }}
            </p>

            <p class="text-xs text-stone-400 mt-1">
                {{ $treatment->end_date?->format('H:i') ?? '' }}
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Productos
            </p>

            <p class="text-2xl font-heading font-bold text-green-700 mt-2">
                {{ $treatment->treatmentDetails->count() }}
            </p>

            <p class="text-xs text-stone-400 mt-1">
                asociados
            </p>

        </div>

    </div>

    {{-- Información --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-xl shadow-sm border border-stone-200">

            <div class="px-6 py-4 border-b border-stone-100">
                <h2 class="font-heading font-bold text-tierra-fertil">
                    Diagnóstico
                </h2>
            </div>

            <div class="p-6">

                <p class="text-sm text-stone-700 leading-relaxed">
                    {{ $treatment->diagnosis }}
                </p>

                @if($treatment->observations)

                    <div class="mt-5 pt-5 border-t border-stone-100">

                        <p class="text-xs uppercase text-stone-400 font-bold">
                            Observaciones
                        </p>

                        <p class="text-sm text-stone-700 mt-2 leading-relaxed">
                            {{ $treatment->observations }}
                        </p>

                    </div>

                @endif

            </div>

        </div>

        <div class="bg-white rounded-xl shadow-sm border border-stone-200">

            <div class="px-6 py-4 border-b border-stone-100">

                <h2 class="font-heading font-bold text-tierra-fertil">
                    Estado del tratamiento
                </h2>

            </div>

            <div class="p-6 space-y-5">

                <div class="flex items-center justify-between">

                    <span class="text-sm text-stone-500">
                        Estado registrado
                    </span>

                    @if($treatment->active)

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                            Activo
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                            Finalizado
                        </span>

                    @endif

                </div>

                <div class="flex items-center justify-between">

                    <span class="text-sm text-stone-500">
                        Fecha de finalización
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        {{ $treatment->end_date?->format('d/m/Y H:i') ?? '—' }}
                    </span>

                </div>

                @if($finalizado && $treatment->active)

                    <div class="rounded-lg bg-yellow-50 border border-yellow-200 p-3">

                        <p class="text-xs text-yellow-800">
                            La fecha de finalización ya pasó, pero el tratamiento continúa marcado como activo.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

    {{-- Productos asociados --}}
    <div class="bg-white rounded-xl shadow-sm border border-stone-200">

        <div class="px-6 py-4 border-b border-stone-100">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="font-heading font-bold text-tierra-fertil">
                        Productos utilizados
                    </h2>

                    <p class="text-xs text-stone-500 mt-1">
                        Productos asociados al tratamiento.
                    </p>

                </div>

                <span class="px-2.5 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                    {{ $treatment->treatmentDetails->count() }}
                </span>

            </div>

        </div>

        <div class="p-6">

            @if($treatment->treatmentDetails->count())

                <div class="space-y-3">

                    @foreach($treatment->treatmentDetails as $detail)

                        <div class="border border-stone-100 rounded-lg p-4">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                                <div>

                                    <p class="font-semibold text-stone-700">
                                        {{ $detail->product->name ?? 'Producto no disponible' }}
                                    </p>

                                    <p class="text-xs text-stone-400 mt-1">
                                        {{ $detail->product->type ?? '—' }}
                                    </p>

                                </div>

                                <div class="text-sm text-stone-600">

                                    <span class="font-semibold">
                                        Cantidad:
                                    </span>

                                    {{ number_format((float) $detail->quantity_used, 2) }}

                                    {{ $detail->product->unit_measurement ?? '' }}

                                </div>

                            </div>

                            @if($detail->frequency || $detail->instructions)

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 pt-4 border-t border-stone-100">

                                    @if($detail->frequency)

                                        <div>

                                            <p class="text-xs uppercase text-stone-400 font-bold">
                                                Frecuencia
                                            </p>

                                            <p class="text-sm text-stone-700 mt-1">
                                                {{ $detail->frequency }}
                                            </p>

                                        </div>

                                    @endif

                                    @if($detail->instructions)

                                        <div>

                                            <p class="text-xs uppercase text-stone-400 font-bold">
                                                Instrucciones
                                            </p>

                                            <p class="text-sm text-stone-700 mt-1">
                                                {{ $detail->instructions }}
                                            </p>

                                        </div>

                                    @endif

                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>

            @else

                <div class="py-8 text-center">

                    <p class="text-sm text-stone-500">
                        Este tratamiento todavía no tiene productos asociados.
                    </p>

                    <p class="text-xs text-stone-400 mt-1">
                        Los productos pueden configurarse posteriormente mediante los detalles del tratamiento.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection