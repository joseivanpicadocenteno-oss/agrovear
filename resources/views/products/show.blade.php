@extends('layouts.app')

@section('title', $product->name)
@section('page_title', 'Ficha del Producto')

@section('content')

<div class="space-y-6">

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    @php
        $stockBajo = $product->current_stock <= $product->min_stock;
        $vencido = $product->expiration_date && $product->expiration_date->isPast();
        $proximoVencer = $product->expiration_date &&
            !$vencido &&
            now()->diffInDays($product->expiration_date, false) <= 30;
    @endphp

    {{-- Encabezado --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 text-sm text-stone-500 mb-2">

                <a href="{{ route('products.index') }}"
                   class="hover:text-verde-natural">
                    Productos
                </a>

                <span>/</span>

                <span>{{ $product->name }}</span>

            </div>

            <div class="flex flex-wrap items-center gap-3">

                <h1 class="text-3xl font-heading font-bold text-tierra-fertil">
                    {{ $product->name }}
                </h1>

                @if($stockBajo)

                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                        Stock bajo
                    </span>

                @else

                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                        Stock disponible
                    </span>

                @endif

            </div>

            <p class="text-stone-500 mt-2">
                {{ $product->type }} · {{ $product->unit_measurement }}
            </p>

        </div>

        {{-- Acciones --}}
        <div class="flex flex-wrap gap-2">

            <a href="{{ route('products.index') }}"
               class="px-4 py-2 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-50 font-semibold text-sm transition">
                ← Productos
            </a>

            <a href="{{ route('products.edit', $product) }}"
               class="px-4 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white font-semibold text-sm transition">
                Editar
            </a>

            <form action="{{ route('products.destroy', $product) }}"
                  method="POST"
                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold text-sm transition">
                    Eliminar
                </button>

            </form>

        </div>

    </div>

    {{-- Resumen --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Stock actual --}}
        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Stock actual
            </p>

            <p class="text-2xl font-heading font-bold {{ $stockBajo ? 'text-red-600' : 'text-green-700' }} mt-2">
                {{ number_format((float) $product->current_stock, 2) }}
            </p>

            <p class="text-sm text-stone-500">
                {{ $product->unit_measurement }}
            </p>

        </div>

        {{-- Stock mínimo --}}
        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Stock mínimo
            </p>

            <p class="text-2xl font-heading font-bold text-tierra-fertil mt-2">
                {{ number_format((float) $product->min_stock, 2) }}
            </p>

            <p class="text-sm text-stone-500">
                Nivel de alerta
            </p>

        </div>

        {{-- Costo --}}
        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Costo por unidad
            </p>

            <p class="text-2xl font-heading font-bold text-tierra-fertil mt-2">
                C$ {{ number_format((float) $product->unit_cost, 2) }}
            </p>

            <p class="text-sm text-stone-500">
                Precio registrado
            </p>

        </div>

        {{-- Vencimiento --}}
        <div class="bg-white p-5 rounded-xl shadow-sm border border-stone-200">

            <p class="text-xs uppercase tracking-wide text-stone-400 font-bold">
                Vencimiento
            </p>

            <p class="text-2xl font-heading font-bold {{ $vencido ? 'text-red-600' : ($proximoVencer ? 'text-yellow-600' : 'text-tierra-fertil') }} mt-2">
                {{ $product->expiration_date?->format('d/m/Y') ?? '—' }}
            </p>

            @if($vencido)

                <p class="text-sm text-red-500 font-semibold">
                    Producto vencido
                </p>

            @elseif($proximoVencer)

                <p class="text-sm text-yellow-600 font-semibold">
                    Próximo a vencer
                </p>

            @else

                <p class="text-sm text-stone-500">
                    Fecha registrada
                </p>

            @endif

        </div>

    </div>

    {{-- Información general --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Datos del producto --}}
        <div class="bg-white rounded-xl shadow-sm border border-stone-200">

            <div class="px-6 py-4 border-b border-stone-100">
                <h2 class="font-heading font-bold text-tierra-fertil">
                    Información del producto
                </h2>
            </div>

            <div class="p-6 space-y-4">

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Nombre
                    </span>

                    <span class="text-sm font-semibold text-stone-700 text-right">
                        {{ $product->name }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Tipo
                    </span>

                    <span class="text-sm font-semibold text-stone-700 text-right">
                        {{ $product->type }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Unidad de medida
                    </span>

                    <span class="text-sm font-semibold text-stone-700 text-right">
                        {{ $product->unit_measurement }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Finca
                    </span>

                    <span class="text-sm font-semibold text-stone-700 text-right">
                        {{ $product->farm->name ?? 'Sin finca' }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Lote
                    </span>

                    <span class="text-sm font-semibold text-stone-700 text-right">
                        {{ $product->batch }}
                    </span>
                </div>

            </div>

        </div>

        {{-- Información económica --}}
        <div class="bg-white rounded-xl shadow-sm border border-stone-200">

            <div class="px-6 py-4 border-b border-stone-100">
                <h2 class="font-heading font-bold text-tierra-fertil">
                    Información económica y compras
                </h2>
            </div>

            <div class="p-6 space-y-4">

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Costo por unidad
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        C$ {{ number_format((float) $product->unit_cost, 2) }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Precio promedio histórico
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        C$ {{ number_format((float) $product->historical_average_price, 2) }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Última compra
                    </span>

                    <span class="text-sm font-semibold text-stone-700">
                        {{ $product->last_purchase_date?->format('d/m/Y') ?? '—' }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-stone-500">
                        Proveedor habitual
                    </span>

                    <span class="text-sm font-semibold text-stone-700 text-right">
                        {{ $product->regular_supplier }}
                    </span>
                </div>

            </div>

        </div>

    </div>

    {{-- Recetas --}}
    <div class="bg-white rounded-xl shadow-sm border border-stone-200">

        <div class="px-6 py-4 border-b border-stone-100">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="font-heading font-bold text-tierra-fertil">
                        Recetas relacionadas
                    </h2>

                    <p class="text-xs text-stone-500 mt-1">
                        Recetas que utilizan este producto.
                    </p>
                </div>

                <span class="px-2.5 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                    {{ $product->recipeDetails->count() }}
                </span>

            </div>

        </div>

        <div class="p-6">

            @if($product->recipeDetails->count())

                <div class="space-y-3">

                    @foreach($product->recipeDetails as $detail)

                        <div class="flex items-center justify-between border border-stone-100 rounded-lg p-4">

                            <div>

                                <p class="font-semibold text-stone-700">
                                    {{ $detail->recipe->name ?? 'Receta no disponible' }}
                                </p>

                                <p class="text-xs text-stone-500 mt-1">
                                    Cantidad utilizada:
                                    {{ number_format((float) $detail->quantity, 2) }}
                                    {{ $product->unit_measurement }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <p class="text-sm text-stone-500">
                    Este producto todavía no está asociado a ninguna receta.
                </p>

            @endif

        </div>

    </div>

    {{-- Tratamientos --}}
    <div class="bg-white rounded-xl shadow-sm border border-stone-200">

        <div class="px-6 py-4 border-b border-stone-100">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="font-heading font-bold text-tierra-fertil">
                        Tratamientos relacionados
                    </h2>

                    <p class="text-xs text-stone-500 mt-1">
                        Tratamientos que utilizan este producto.
                    </p>
                </div>

                <span class="px-2.5 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-bold">
                    {{ $product->treatmentDetails->count() }}
                </span>

            </div>

        </div>

        <div class="p-6">

            @if($product->treatmentDetails->count())

                <div class="space-y-3">

                    @foreach($product->treatmentDetails as $detail)

                        <div class="border border-stone-100 rounded-lg p-4">

                            <p class="font-semibold text-stone-700">
                                {{ $detail->treatment->name ?? 'Tratamiento no disponible' }}
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3 text-xs text-stone-500">

                                <div>
                                    <span class="font-semibold text-stone-600">
                                        Cantidad:
                                    </span>

                                    {{ number_format((float) $detail->quantity_used, 2) }}
                                    {{ $product->unit_measurement }}
                                </div>

                                <div>
                                    <span class="font-semibold text-stone-600">
                                        Frecuencia:
                                    </span>

                                    {{ $detail->frequency ?? '—' }}
                                </div>

                                <div>
                                    <span class="font-semibold text-stone-600">
                                        Instrucciones:
                                    </span>

                                    {{ $detail->instructions ?? '—' }}
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <p class="text-sm text-stone-500">
                    Este producto todavía no está asociado a ningún tratamiento.
                </p>

            @endif

        </div>

    </div>

</div>

@endsection