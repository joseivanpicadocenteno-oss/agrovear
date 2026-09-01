@extends('layouts.app')

@section('title', $farm->name)
@section('page_title', 'Detalles de la Finca')

@section('content')
<div class="space-y-6">
    <!-- Header de la Finca -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-stone-200 flex justify-between items-center">
        <div>
            <h3 class="font-heading font-bold text-2xl text-tierra-fertil">{{ $farm->name }}</h3>
            <p class="text-stone-500 text-sm">{{ $farm->municipality }}, {{ $farm->department }} — Tel: {{ $farm->phone }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('farms.edit', $farm) }}" class="bg-oro-maiz text-stone-900 font-bold px-4 py-2 rounded-lg text-sm shadow-sm hover:bg-opacity-90">Editar Finca</a>
            <a href="{{ route('farms.index') }}" class="bg-stone-200 text-stone-700 font-bold px-4 py-2 rounded-lg text-sm hover:bg-stone-300">Volver</a>
        </div>
    </div>

    <!-- Contadores del Predio -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl border border-stone-200 shadow-sm border-l-4 border-l-verde-natural">
            <span class="text-xs font-heading font-bold text-stone-500 uppercase">Animales Registrados</span>
            <p class="text-3xl font-heading font-bold text-tierra-fertil mt-2">{{ $farm->animals->count() }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-stone-200 shadow-sm border-l-4 border-l-oro-maiz">
            <span class="text-xs font-heading font-bold text-stone-500 uppercase">Productos en Stock</span>
            <p class="text-3xl font-heading font-bold text-tierra-fertil mt-2">{{ $farm->products->count() }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl border border-stone-200 shadow-sm border-l-4 border-l-tierra-fertil">
            <span class="text-xs font-heading font-bold text-stone-500 uppercase">Dietas Creadas</span>
            <p class="text-3xl font-heading font-bold text-tierra-fertil mt-2">{{ $farm->recipes->count() }}</p>
        </div>
    </div>
</div>
@endsection