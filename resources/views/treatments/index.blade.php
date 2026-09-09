@extends('layouts.app')

@section('title', 'Tratamientos')
@section('page_title', 'Tratamientos Veterinarios')

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
                Tratamientos Veterinarios
            </h2>

            <p class="text-sm text-stone-500 mt-1">
                Controla los tratamientos, diagnósticos y seguimiento de salud de tus animales.
            </p>
        </div>

        <a href="{{ route('treatments.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2.5 rounded-lg shadow-sm transition">
            <span class="text-lg">+</span>
            Nuevo Tratamiento
        </a>

    </div>

    <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden">

        @if($treatments->count())

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-stone-50 border-b border-stone-200">

                        <tr class="text-left">

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Tratamiento
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Animal
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Inicio
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Finalización
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Diagnóstico
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

                        @foreach($treatments as $treatment)

                            <tr class="hover:bg-stone-50 transition">

                                <td class="px-5 py-4">

                                    <div class="font-semibold text-tierra-fertil">
                                        {{ $treatment->name }}
                                    </div>

                                    <div class="text-xs text-stone-400 mt-1">
                                        {{ $treatment->treatmentDetails->count() }}
                                        productos asociados
                                    </div>

                                </td>

                                <td class="px-5 py-4">

                                    <div class="font-semibold text-stone-700">
                                        {{ $treatment->animal->name ?? 'Animal eliminado' }}
                                    </div>

                                    @if($treatment->animal?->farm)
                                        <div class="text-xs text-stone-400 mt-1">
                                            {{ $treatment->animal->farm->name }}
                                        </div>
                                    @endif

                                </td>

                                <td class="px-5 py-4 text-stone-600">
                                    {{ $treatment->start_date?->format('d/m/Y H:i') ?? '—' }}
                                </td>

                                <td class="px-5 py-4 text-stone-600">
                                    {{ $treatment->end_date?->format('d/m/Y H:i') ?? '—' }}
                                </td>

                                <td class="px-5 py-4">

                                    <span class="text-stone-600">
                                        {{ \Illuminate\Support\Str::limit($treatment->diagnosis, 50) }}
                                    </span>

                                </td>

                                <td class="px-5 py-4">

                                    @if($treatment->active)

                                        <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                            Activo
                                        </span>

                                    @else

                                        <span class="px-2.5 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                                            Finalizado
                                        </span>

                                    @endif

                                </td>

                                <td class="px-5 py-4">

                                    <div class="flex justify-end items-center gap-2">

                                        <a href="{{ route('treatments.show', $treatment) }}"
                                           class="px-3 py-1.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-100 text-xs font-semibold">
                                            Ver
                                        </a>

                                        <a href="{{ route('treatments.edit', $treatment) }}"
                                           class="px-3 py-1.5 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold">
                                            Editar
                                        </a>

                                        <form action="{{ route('treatments.destroy', $treatment) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Deseas eliminar este tratamiento?');">

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
                {{ $treatments->links() }}
            </div>

        @else

            <div class="px-6 py-16 text-center">

                <div class="text-5xl mb-4">
                    🩺
                </div>

                <h3 class="text-lg font-heading font-bold text-tierra-fertil">
                    No hay tratamientos registrados
                </h3>

                <p class="text-sm text-stone-500 mt-2 mb-6">
                    Registra un tratamiento para comenzar a llevar el control veterinario.
                </p>

                <a href="{{ route('treatments.create') }}"
                   class="inline-flex items-center gap-2 bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2.5 rounded-lg">
                    + Registrar tratamiento
                </a>

            </div>

        @endif

    </div>

</div>

@endsection