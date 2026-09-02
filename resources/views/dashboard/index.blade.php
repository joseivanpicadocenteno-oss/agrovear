@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- Bienvenida --}}
    <section>

        <p class="text-sm text-stone-500 mb-1">
            Panel principal
        </p>

        <h2 class="font-heading text-3xl font-bold text-[#603813]">
            Buenos días, {{ auth()->user()->name }}
        </h2>

        <p class="text-stone-600 mt-2">
            Consulta y administra la información de tus fincas.
        </p>

    </section>


    {{-- Estadísticas --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="bg-white rounded-2xl border border-stone-200
                    p-6 shadow-sm">

            <p class="text-xs uppercase tracking-wide
                      text-stone-500 font-bold">
                Fincas
            </p>

            <p class="mt-3 text-3xl font-heading font-bold
                      text-[#603813]">
                {{ $farmsCount ?? 0 }}
            </p>

        </div>


        <div class="bg-white rounded-2xl border border-stone-200
                    p-6 shadow-sm">

            <p class="text-xs uppercase tracking-wide
                      text-stone-500 font-bold">
                Animales
            </p>

            <p class="mt-3 text-3xl font-heading font-bold
                      text-[#397C0E]">
                {{ $animalsCount ?? 0 }}
            </p>

        </div>


        <div class="bg-white rounded-2xl border border-stone-200
                    p-6 shadow-sm">

            <p class="text-xs uppercase tracking-wide
                      text-stone-500 font-bold">
                Productos
            </p>

            <p class="mt-3 text-3xl font-heading font-bold
                      text-[#F2A900]">
                {{ $productsCount ?? 0 }}
            </p>

        </div>


        <div class="bg-white rounded-2xl border border-stone-200
                    p-6 shadow-sm">

            <p class="text-xs uppercase tracking-wide
                      text-stone-500 font-bold">
                Recetas
            </p>

            <p class="mt-3 text-3xl font-heading font-bold
                      text-[#603813]">
                {{ $recipesCount ?? 0 }}
            </p>

        </div>

    </section>


    {{-- Acciones rápidas --}}
    <section>

        <h3 class="font-heading font-bold text-xl text-[#603813] mb-4">
            Acciones rápidas
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

            <a href="{{ route('animals.create') }}"
               class="bg-[#397C0E] text-white rounded-xl p-5
                      hover:shadow-lg transition">

                <p class="font-heading font-bold text-lg">
                    Registrar animal
                </p>

                <p class="text-sm text-white/80 mt-1">
                    Agrega un nuevo animal a una finca.
                </p>

            </a>


            <a href="{{ route('products.create') }}"
               class="bg-white border border-stone-200 rounded-xl
                      p-5 hover:shadow-lg transition">

                <p class="font-heading font-bold text-lg text-[#603813]">
                    Registrar producto
                </p>

                <p class="text-sm text-stone-500 mt-1">
                    Administra el inventario.
                </p>

            </a>


            <a href="{{ route('recipes.create') }}"
               class="bg-white border border-stone-200 rounded-xl
                      p-5 hover:shadow-lg transition">

                <p class="font-heading font-bold text-lg text-[#603813]">
                    Crear receta
                </p>

                <p class="text-sm text-stone-500 mt-1">
                    Diseña una dieta para tus animales.
                </p>

            </a>


            <a href="{{ route('feedings.create') }}"
               class="bg-[#F2A900] rounded-xl p-5
                      hover:shadow-lg transition">

                <p class="font-heading font-bold text-lg text-[#603813]">
                    Registrar alimentación
                </p>

                <p class="text-sm text-[#603813]/80 mt-1">
                    Registra el alimento servido.
                </p>

            </a>

        </div>

    </section>

</div>

@endsection