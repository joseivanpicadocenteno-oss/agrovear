@extends('layouts.app')

@section('title', 'Registro de Alimentación')
@section('page_title', 'Ficha de Alimentación')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 text-sm text-stone-500 mb-2">

                <a href="{{ route('feedings.index') }}"
                   class="hover:text-verde-natural">
                    Alimentación
                </a>

                <span>/</span>

                <span>Registro #{{ $feeding->id }}</span>

            </div>

            <h1 class="text-3xl font-heading font-bold text-tierra-fertil">
                Registro de Alimentación
            </h1>

            <p class="text-stone-500 mt-2">
                {{ $feeding->feeding_date?->format('d/m/Y') }}
            </p>

        </div>

        <div class="flex flex-wrap gap-2">

            <a href="{{ route('feedings.index') }}"
               class="px-4 py-2 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm">
                ← Alimentación
            </a>

            <a href="{{ route('feedings.edit', $feeding) }}"
               class="px-4 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white font-semibold text-sm">
                Editar
            </a>

            <form action="{{ route('feedings.destroy', $feeding) }}"
                  method="POST"
                  onsubmit="return confirm('¿Deseas eliminar este registro?');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold text-sm">
                    Eliminar
                </button>

            </form>

        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Animal
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ $feeding->animal->name ?? '—' }}
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Receta
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ $feeding->recipe->name ?? '—' }}
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Cantidad servida
            </p>

            <p class="text-xl font-heading font-bold text-tierra-fertil mt-2">
                {{ number_format((float) $feeding->amount_served, 2) }}
            </p>

        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Costo estimado
            </p>

            <p class="text-xl font-heading font-bold text-green-700 mt-2">
                C$ {{ number_format((float) $feeding->estimated_feed_cost, 2) }}
            </p>

        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-xl shadow-sm border border-stone-200">

            <div class="px-6 py-4 border-b border-stone-100">
                <h2 class="font-heading font-bold text-tierra-fertil">
                    Información del registro
                </h2>
            </div>

            <div class="p-6 space-y-4">

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Fecha
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        {{ $feeding->feeding_date?->format('d/m/Y') ?? '—' }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Finca
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        {{ $feeding->animal->farm->name ?? '—' }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Gestación
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        {{ $feeding->gestationRecord ? 'Relacionada' : 'No corresponde' }}
                    </span>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-xl shadow-sm border border-stone-200">

            <div class="px-6 py-4 border-b border-stone-100">

                <h2 class="font-heading font-bold text-tierra-fertil">
                    Productos de la receta
                </h2>

            </div>

            <div class="p-6">

                @if($feeding->recipe?->recipeDetails?->count())

                    <div class="space-y-3">

                        @foreach($feeding->recipe->recipeDetails as $detail)

                            <div class="flex justify-between gap-4 border border-stone-100 rounded-lg p-3">

                                <div>

                                    <p class="text-sm font-semibold text-stone-700">
                                        {{ $detail->product->name ?? 'Producto' }}
                                    </p>

                                    <p class="text-xs text-stone-400 mt-1">
                                        Cantidad:
                                        {{ number_format((float) $detail->quantity, 2) }}
                                        {{ $detail->product->unit_measurement ?? '' }}
                                    </p>

                                </div>

                                <div class="text-sm font-semibold text-stone-600">
                                    C$ {{ number_format((float) ($detail->product->unit_cost ?? 0), 2) }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <p class="text-sm text-stone-500">
                        La receta no tiene productos asociados.
                    </p>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection