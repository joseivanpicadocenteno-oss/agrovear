@extends('layouts.app')

@section('title', 'Editar Animal')
@section('page_title', 'Editar Animal')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-stone-500 mb-2">
            <a href="{{ route('animals.index') }}" class="hover:text-verde-natural">
                Animales
            </a>

            <span>/</span>

            <a href="{{ route('animals.show', $animal) }}" class="hover:text-verde-natural">
                {{ $animal->name }}
            </a>

            <span>/</span>

            <span>Editar</span>
        </div>

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3">

            <div>
                <h1 class="font-heading text-2xl font-bold text-tierra-fertil">
                    Editar {{ $animal->name }}
                </h1>

                <p class="text-sm text-stone-500 mt-1">
                    Actualiza la información y el estado del animal.
                </p>
            </div>

            <span class="inline-flex items-center w-fit px-3 py-1.5 rounded-full text-xs font-bold
                {{ $animal->active
                    ? 'bg-green-100 text-green-800'
                    : 'bg-stone-100 text-stone-600' }}">
                <span class="w-2 h-2 rounded-full mr-2
                    {{ $animal->active ? 'bg-green-500' : 'bg-stone-400' }}">
                </span>

                {{ $animal->active ? 'Activo' : 'Inactivo' }}
            </span>
        </div>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
            <p class="font-semibold text-sm text-red-800">
                Revisa los datos ingresados.
            </p>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6 md:p-8">
        @include('animals.form', ['animal' => $animal])
    </div>

</div>

@endsection