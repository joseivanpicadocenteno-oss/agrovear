<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Agrovear')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F5F0E6] text-stone-800">

<div class="min-h-screen flex">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Contenido --}}
    <div class="flex-1 min-w-0">

        {{-- Barra superior --}}
        <header class="h-16 bg-white border-b border-stone-200
                       flex items-center justify-between px-6
                       sticky top-0 z-30">

            <div>
                <h1 class="font-heading font-bold text-[#603813] text-xl">
                    @yield('page_title', 'Agrovear')
                </h1>
            </div>

            <div class="flex items-center gap-4">

                <div class="text-right hidden sm:block">
                    <p class="text-xs text-stone-500">
                        Sesión iniciada como
                    </p>

                    <p class="font-bold text-sm text-[#603813]">
                        {{ auth()->user()->name ?? 'Usuario' }}
                    </p>
                </div>

                <div class="w-10 h-10 rounded-full bg-[#397C0E]
                            text-white flex items-center justify-center
                            font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>

            </div>

        </header>

        <main class="p-6 lg:p-8">

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="mb-6 flex items-center justify-between
                            bg-green-50 border border-green-200
                            text-green-800 px-4 py-3 rounded-xl">

                    <span class="font-semibold text-sm">
                        {{ session('success') }}
                    </span>

                    <button
                        onclick="this.parentElement.remove()"
                        class="font-bold text-green-700">
                        ×
                    </button>
                </div>
            @endif

            {{-- Mensaje de error --}}
            @if(session('error'))
                <div class="mb-6 flex items-center justify-between
                            bg-red-50 border border-red-200
                            text-red-800 px-4 py-3 rounded-xl">

                    <span class="font-semibold text-sm">
                        {{ session('error') }}
                    </span>

                    <button
                        onclick="this.parentElement.remove()"
                        class="font-bold text-red-700">
                        ×
                    </button>
                </div>
            @endif

            {{-- Errores de validación --}}
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200
                            text-red-800 px-4 py-3 rounded-xl">

                    <p class="font-bold text-sm mb-2">
                        Revisa los siguientes errores:
                    </p>

                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            @yield('content')

        </main>

    </div>
</div>

</body>
</html>