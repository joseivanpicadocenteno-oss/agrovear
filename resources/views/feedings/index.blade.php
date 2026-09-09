@extends('layouts.app')

@section('title', 'Alimentación')
@section('page_title', 'Registros de Alimentación')

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
                Registros de Alimentación
            </h2>

            <p class="text-sm text-stone-500 mt-1">
                Controla las raciones suministradas y el costo estimado de alimentación.
            </p>
        </div>

        <a href="{{ route('feedings.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2.5 rounded-lg shadow-sm transition">
            <span class="text-lg">+</span>
            Registrar Alimentación
        </a>

    </div>

    <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden">

        @if($feedings->count())

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-stone-50 border-b border-stone-200">

                        <tr class="text-left">

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Fecha
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Animal
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Receta
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Cantidad
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Costo estimado
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil text-right">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-stone-100">

                        @foreach($feedings as $feeding)

                            <tr class="hover:bg-stone-50 transition">

                                <td class="px-5 py-4 text-stone-600">
                                    {{ $feeding->feeding_date?->format('d/m/Y') ?? '—' }}
                                </td>

                                <td class="px-5 py-4">

                                    <div class="font-semibold text-tierra-fertil">
                                        {{ $feeding->animal->name ?? 'Animal eliminado' }}
                                    </div>

                                    @if($feeding->animal?->farm)
                                        <div class="text-xs text-stone-400 mt-1">
                                            {{ $feeding->animal->farm->name }}
                                        </div>
                                    @endif

                                </td>

                                <td class="px-5 py-4">

                                    <span class="px-2.5 py-1 rounded-full bg-green-50 text-green-700 text-xs font-semibold">
                                        {{ $feeding->recipe->name ?? 'Receta eliminada' }}
                                    </span>

                                </td>

                                <td class="px-5 py-4 text-stone-600">
                                    {{ number_format((float) $feeding->amount_served, 2) }}
                                </td>

                                <td class="px-5 py-4 font-bold text-tierra-fertil">
                                    C$ {{ number_format((float) $feeding->estimated_feed_cost, 2) }}
                                </td>

                                <td class="px-5 py-4">

                                    <div class="flex justify-end items-center gap-2">

                                        <a href="{{ route('feedings.show', $feeding) }}"
                                           class="px-3 py-1.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-100 text-xs font-semibold">
                                            Ver
                                        </a>

                                        <a href="{{ route('feedings.edit', $feeding) }}"
                                           class="px-3 py-1.5 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold">
                                            Editar
                                        </a>

                                        <form action="{{ route('feedings.destroy', $feeding) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Deseas eliminar este registro de alimentación?');">

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
                {{ $feedings->links() }}
            </div>

        @else

            <div class="px-6 py-16 text-center">

                <div class="text-5xl mb-4">
                    🍽️
                </div>

                <h3 class="text-lg font-heading font-bold text-tierra-fertil">
                    No hay registros de alimentación
                </h3>

                <p class="text-sm text-stone-500 mt-2 mb-6">
                    Registra la primera alimentación de uno de tus animales.
                </p>

                <a href="{{ route('feedings.create') }}"
                   class="inline-flex items-center gap-2 bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2.5 rounded-lg">
                    + Registrar alimentación
                </a>

            </div>

        @endif

    </div>

</div>

@endsection