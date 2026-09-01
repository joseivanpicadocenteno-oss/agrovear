@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Resumen General')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-stone-200 shadow-sm border-l-4 border-l-verde-natural">
        <span class="text-xs font-heading font-bold text-stone-500 uppercase tracking-wider">Fincas Activas</span>
        <p class="text-3xl font-heading font-bold text-tierra-fertil mt-2">
            {{ \App\Models\Farm::where('user_id', auth()->id())->count() }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl border border-stone-200 shadow-sm border-l-4 border-l-oro-maiz">
        <span class="text-xs font-heading font-bold text-stone-500 uppercase tracking-wider">Total Animales</span>
        <p class="text-3xl font-heading font-bold text-tierra-fertil mt-2">
            {{ \App\Models\Animal::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))->count() }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl border border-stone-200 shadow-sm border-l-4 border-l-verde-natural">
        <span class="text-xs font-heading font-bold text-stone-500 uppercase tracking-wider">Dietas/Recetas</span>
        <p class="text-3xl font-heading font-bold text-tierra-fertil mt-2">
            {{ \App\Models\Recipe::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))->count() }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl border border-stone-200 shadow-sm border-l-4 border-l-tierra-fertil">
        <span class="text-xs font-heading font-bold text-stone-500 uppercase tracking-wider">Productos Stock</span>
        <p class="text-3xl font-heading font-bold text-tierra-fertil mt-2">
            {{ \App\Models\Product::whereHas('farm', fn($q) => $q->where('user_id', auth()->id()))->count() }}
        </p>
    </div>
</div>

<div class="bg-white p-6 rounded-xl border border-stone-200 shadow-sm">
    <h3 class="font-heading font-bold text-lg text-tierra-fertil mb-4">Acceso Rápido a Módulos</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('farms.create') }}" class="p-4 rounded-lg bg-luz-natural hover:bg-stone-200 border border-stone-300 transition text-center font-heading font-bold text-verde-natural text-sm">
            + Registrar Nueva Finca
        </a>
        <a href="{{ route('animals.create') }}" class="p-4 rounded-lg bg-luz-natural hover:bg-stone-200 border border-stone-300 transition text-center font-heading font-bold text-verde-natural text-sm">
            + Añadir Animal al Hato
        </a>
        <a href="{{ route('products.create') }}" class="p-4 rounded-lg bg-luz-natural hover:bg-stone-200 border border-stone-300 transition text-center font-heading font-bold text-verde-natural text-sm">
            + Ingresar Inventario
        </a>
    </div>
</div>
@endsection