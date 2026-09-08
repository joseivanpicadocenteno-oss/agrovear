@extends('layouts.app')

@section('title', 'Nuevo Animal')
@section('page_title', 'Registrar Nuevo Animal')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Encabezado --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-stone-500 mb-2">
            <a href="{{ route('animals.index') }}" class="hover:text-verde-natural">
                Animales
            </a>

            <span>/</span>

            <span>Nuevo registro</span>
        </div>

        <h1 class="font-heading text-2xl font-bold text-tierra-fertil">
            Registrar nuevo animal
        </h1>

        <p class="text-sm text-stone-500 mt-1">
            Ingresa la información necesaria para incorporar un animal a tu finca.
        </p>
    </div>

    {{-- Errores generales --}}
    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
            <div class="flex gap-3">
                <div class="text-red-600 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M4.93 19h14.14c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.2 16c-.77 1.33.19 3 1.73 3z"/>
                    </svg>
                </div>

                <div>
                    <p class="font-semibold text-sm text-red-800">
                        Revisa los datos ingresados
                    </p>

                    <p class="text-xs text-red-700 mt-1">
                        Hay campos que necesitan corrección.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6 md:p-8">
        @include('animals.form')
    </div>

</div>

@endsection