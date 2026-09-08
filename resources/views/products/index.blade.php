@extends('layouts.app')

@section('title', 'Productos')
@section('page_title', 'Productos e Insumos')

@section('content')

<div class="space-y-6">

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h2 class="text-2xl font-heading font-bold text-tierra-fertil">
                Productos e Insumos
            </h2>

            <p class="text-sm text-stone-500 mt-1">
                Administra alimentos, medicamentos, suplementos y demás insumos de tus fincas.
            </p>
        </div>

        <a href="{{ route('products.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2.5 rounded-lg shadow-sm transition">

            <span class="text-lg">+</span>
            Nuevo Producto

        </a>

    </div>

    {{-- Tabla --}}
    <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden">

        @if($products->count() > 0)

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-stone-50 border-b border-stone-200">

                        <tr class="text-left">

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Producto
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Tipo
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Finca
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Stock
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Stock mínimo
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Costo
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil">
                                Vencimiento
                            </th>

                            <th class="px-5 py-4 font-heading font-bold text-tierra-fertil text-right">
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-stone-100">

                        @foreach($products as $product)

                            @php
                                $stockBajo = $product->current_stock <= $product->min_stock;
                                $vencido = $product->expiration_date &&
                                    $product->expiration_date->isPast();
                            @endphp

                            <tr class="hover:bg-stone-50 transition">

                                {{-- Producto --}}
                                <td class="px-5 py-4">

                                    <div class="font-semibold text-tierra-fertil">
                                        {{ $product->name }}
                                    </div>

                                    <div class="text-xs text-stone-400 mt-1">
                                        Lote: {{ $product->batch }}
                                    </div>

                                </td>

                                {{-- Tipo --}}
                                <td class="px-5 py-4">

                                    <span class="inline-flex px-2.5 py-1 rounded-full bg-stone-100 text-stone-700 text-xs font-semibold">
                                        {{ $product->type }}
                                    </span>

                                </td>

                                {{-- Finca --}}
                                <td class="px-5 py-4 text-stone-600">
                                    {{ $product->farm->name ?? 'Sin finca' }}
                                </td>

                                {{-- Stock --}}
                                <td class="px-5 py-4">

                                    <div class="font-bold {{ $stockBajo ? 'text-red-600' : 'text-green-700' }}">
                                        {{ number_format((float) $product->current_stock, 2) }}
                                    </div>

                                    <div class="text-xs text-stone-400">
                                        {{ $product->unit_measurement }}
                                    </div>

                                </td>

                                {{-- Stock mínimo --}}
                                <td class="px-5 py-4 text-stone-600">
                                    {{ number_format((float) $product->min_stock, 2) }}
                                </td>

                                {{-- Costo --}}
                                <td class="px-5 py-4 text-stone-700 font-semibold">
                                    C$ {{ number_format((float) $product->unit_cost, 2) }}
                                </td>

                                {{-- Vencimiento --}}
                                <td class="px-5 py-4">

                                    <div class="{{ $vencido ? 'text-red-600 font-bold' : 'text-stone-600' }}">
                                        {{ $product->expiration_date?->format('d/m/Y') ?? '—' }}
                                    </div>

                                    @if($vencido)

                                        <span class="text-xs text-red-500 font-semibold">
                                            Vencido
                                        </span>

                                    @endif

                                </td>

                                {{-- Acciones --}}
                                <td class="px-5 py-4">

                                    <div class="flex justify-end items-center gap-2">

                                        {{-- Ver --}}
                                        <a href="{{ route('products.show', $product) }}"
                                           class="px-3 py-1.5 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-100 text-xs font-semibold transition">
                                            Ver
                                        </a>

                                        {{-- Editar --}}
                                        <a href="{{ route('products.edit', $product) }}"
                                           class="px-3 py-1.5 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold transition">
                                            Editar
                                        </a>

                                        {{-- Eliminar --}}
                                        <form action="{{ route('products.destroy', $product) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="px-3 py-1.5 rounded-lg bg-red-600 hover:bg-red-700 text-white text-xs font-semibold transition">
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

            {{-- Paginación --}}
            <div class="px-5 py-4 border-t border-stone-200">
                {{ $products->links() }}
            </div>

        @else

            {{-- Estado vacío --}}
            <div class="px-6 py-16 text-center">

                <div class="text-5xl mb-4">
                    📦
                </div>

                <h3 class="text-lg font-heading font-bold text-tierra-fertil">
                    No hay productos registrados
                </h3>

                <p class="text-sm text-stone-500 mt-2 mb-6">
                    Comienza registrando el primer producto o insumo de tus fincas.
                </p>

                <a href="{{ route('products.create') }}"
                   class="inline-flex items-center gap-2 bg-verde-natural hover:bg-opacity-90 text-white font-heading font-bold px-5 py-2.5 rounded-lg shadow-sm transition">
                    + Registrar producto
                </a>

            </div>

        @endif

    </div>

</div>

@endsection