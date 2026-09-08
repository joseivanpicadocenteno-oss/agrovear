@extends('layouts.app')

@section('title', 'Animales')
@section('page_title', 'Animales')

@section('content')

<div class="space-y-6">


    {{-- Encabezado --}}
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">

        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-verde-natural">
                Gestión del ganado
            </p>

            <h1 class="font-heading text-2xl font-bold text-tierra-fertil mt-1">
                Animales
            </h1>

            <p class="text-sm text-stone-500 mt-1">
                Consulta, registra y administra los animales de tus fincas.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

            {{-- Volver al Dashboard --}}
            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center justify-center gap-2
                       px-4 py-3 rounded-xl
                       border border-stone-300
                       bg-white
                       text-[#603813]
                       font-semibold text-sm
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

            {{-- Registrar animal --}}
            <a
                href="{{ route('animals.create') }}"
                class="inline-flex items-center justify-center gap-2
                       px-5 py-3 rounded-xl
                       bg-[#397C0E]
                       text-white
                       font-heading font-bold text-sm
                       shadow-sm
                       hover:bg-[#2f680b]
                       transition"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Registrar animal
            </a>

        </div>

    </div>

    {{-- Mensaje --}}
    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center text-green-700">
                ✓
            </div>

            <div>
                <p class="font-semibold text-sm text-green-800">
                    Operación realizada
                </p>

                <p class="text-xs text-green-700">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    @endif


    {{-- Estadísticas --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">

        <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm">
            <p class="text-xs font-semibold text-stone-500 uppercase tracking-wide">
                Total
            </p>

            <p class="font-heading text-2xl font-bold text-tierra-fertil mt-2">
                {{ $stats['total'] }}
            </p>

            <p class="text-xs text-stone-400 mt-1">
                animales registrados
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-green-200 p-5 shadow-sm">
            <p class="text-xs font-semibold text-green-700 uppercase tracking-wide">
                Activos
            </p>

            <p class="font-heading text-2xl font-bold text-green-800 mt-2">
                {{ $stats['active'] }}
            </p>

            <p class="text-xs text-green-600 mt-1">
                en operación
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm">
            <p class="text-xs font-semibold text-stone-500 uppercase tracking-wide">
                Inactivos
            </p>

            <p class="font-heading text-2xl font-bold text-stone-700 mt-2">
                {{ $stats['inactive'] }}
            </p>

            <p class="text-xs text-stone-400 mt-1">
                en historial
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-pink-200 p-5 shadow-sm">
            <p class="text-xs font-semibold text-pink-600 uppercase tracking-wide">
                Hembras
            </p>

            <p class="font-heading text-2xl font-bold text-pink-800 mt-2">
                {{ $stats['females'] }}
            </p>

            <p class="text-xs text-pink-500 mt-1">
                registrados
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-blue-200 p-5 shadow-sm">
            <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide">
                Machos
            </p>

            <p class="font-heading text-2xl font-bold text-blue-800 mt-2">
                {{ $stats['males'] }}
            </p>

            <p class="text-xs text-blue-500 mt-1">
                registrados
            </p>
        </div>
    </div>


    {{-- Filtros --}}
    <form
        action="{{ route('animals.index') }}"
        method="GET"
        class="bg-white rounded-2xl border border-stone-200 shadow-sm p-4"
    >
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3">

            <div class="lg:col-span-2 relative">
                <svg
                    class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-stone-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Buscar por nombre o raza..."
                    class="w-full rounded-xl border border-stone-300 pl-10 pr-4 py-2.5 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >
            </div>

            <select
                name="species"
                class="rounded-xl border border-stone-300 bg-white px-3 py-2.5 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
            >
                <option value="">Todas las especies</option>

                @foreach(['Bovino', 'Porcino', 'Ovino', 'Caprino'] as $species)
                    <option value="{{ $species }}" @selected(request('species') === $species)>
                        {{ $species }}
                    </option>
                @endforeach
            </select>

            <select
                name="sex"
                class="rounded-xl border border-stone-300 bg-white px-3 py-2.5 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
            >
                <option value="">Todos los sexos</option>
                <option value="Hembra" @selected(request('sex') === 'Hembra')>Hembras</option>
                <option value="Macho" @selected(request('sex') === 'Macho')>Machos</option>
            </select>

            <select
                name="farm_id"
                class="rounded-xl border border-stone-300 bg-white px-3 py-2.5 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
            >
                <option value="">Todas las fincas</option>

                @foreach($farms as $farm)
                    <option
                        value="{{ $farm->id }}"
                        @selected(request('farm_id') == $farm->id)
                    >
                        {{ $farm->name }}
                    </option>
                @endforeach
            </select>

        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 mt-4 pt-4 border-t border-stone-100">

            <select
                name="active"
                class="rounded-xl border border-stone-300 bg-white px-3 py-2 text-xs focus:border-verde-natural outline-none"
            >
                <option value="">Todos los estados</option>
                <option value="1" @selected(request('active') === '1')>Activos</option>
                <option value="0" @selected(request('active') === '0')>Inactivos</option>
            </select>

            <div class="flex items-center gap-2">
                <a
                    href="{{ route('animals.index') }}"
                    class="px-4 py-2 rounded-lg text-xs font-semibold text-stone-500 hover:bg-stone-50"
                >
                    Limpiar
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-tierra-fertil text-white text-xs font-bold hover:opacity-90"
                >
                    Aplicar filtros
                </button>
            </div>
        </div>
    </form>


    {{-- Tabla --}}
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">

        @if($animals->count())

            <div class="overflow-x-auto">
                <table class="w-full text-left">

                    <thead class="bg-stone-50 border-b border-stone-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-stone-500">
                                Animal
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-stone-500">
                                Finca
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-stone-500">
                                Especie
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-stone-500">
                                Sexo
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-stone-500">
                                Peso
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wide text-stone-500">
                                Estado
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide text-stone-500">
                                Acción
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-stone-100">

                        @foreach($animals as $animal)

                            <tr class="hover:bg-stone-50 transition">

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 rounded-xl bg-green-50 text-verde-natural flex items-center justify-center font-heading font-bold">
                                            {{ strtoupper(substr($animal->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-semibold text-sm text-tierra-fertil">
                                                {{ $animal->name }}
                                            </p>

                                            <p class="text-xs text-stone-400">
                                                {{ $animal->breed }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-stone-600">
                                    {{ $animal->farm->name ?? 'Sin finca' }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-stone-100 text-stone-600">
                                        {{ $animal->species }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-stone-600">
                                    {{ $animal->sex }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-semibold text-sm text-tierra-fertil">
                                        {{ number_format((float) $animal->weight_kg, 2) }}
                                    </span>

                                    <span class="text-xs text-stone-400">
                                        kg
                                    </span>
                                </td>

                                <td class="px-6 py-4">
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
                                </td>

                                <td class="px-6 py-4 text-right">

                                    <div class="flex justify-end items-center gap-2">

                                        <a
                                            href="{{ route('animals.show', $animal) }}"
                                            class="p-2 rounded-lg text-stone-500 hover:text-verde-natural hover:bg-green-50 transition"
                                            title="Ver ficha"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27 2.94 9.54 7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7z"/>
                                            </svg>
                                        </a>

                                        <a
                                            href="{{ route('animals.edit', $animal) }}"
                                            class="p-2 rounded-lg text-stone-500 hover:text-amber-600 hover:bg-amber-50 transition"
                                            title="Editar"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                            </svg>
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="px-6 py-4 border-t border-stone-100">
                {{ $animals->links() }}
            </div>

        @else

            <div class="px-6 py-16 text-center">

                <div class="w-16 h-16 rounded-2xl bg-green-50 text-verde-natural flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                </div>

                <h3 class="font-heading text-lg font-bold text-tierra-fertil">
                    No encontramos animales
                </h3>

                <p class="text-sm text-stone-500 mt-1 max-w-md mx-auto">
                    No hay animales que coincidan con los filtros actuales.
                </p>

                <a
                    href="{{ route('animals.create') }}"
                    class="inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-xl bg-verde-natural text-white text-sm font-bold"
                >
                    Registrar primer animal
                </a>

            </div>

        @endif

    </div>

</div>

@endsection