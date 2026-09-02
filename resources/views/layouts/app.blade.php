<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agrovear')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-100 font-sans antialiased text-stone-800">
    <div class="flex min-h-screen">
        
        {{-- Incluimos la barra lateral reusable --}}
        @include('layouts.sidebar')

        {{-- Área de Contenido Principal --}}
        <main class="flex-1 p-8 overflow-y-auto">
            
            {{-- Encabezado de Página --}}
            <header class="mb-6 border-b border-stone-200 pb-4">
                <h1 class="text-2xl font-heading font-bold text-tierra-fertil">@yield('page_title')</h1>
            </header>

            {{-- Alertas Globales de Éxito o Error --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg text-sm font-semibold flex justify-between items-center shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-green-900 hover:text-green-700 font-bold ml-4">✕</button>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg text-sm font-semibold flex justify-between items-center shadow-sm">
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-red-900 hover:text-red-700 font-bold ml-4">✕</button>
                </div>
            @endif

            {{-- Contenido inyectado desde cada vista con @section('content') --}}
            @yield('content')

        </main>
    </div>
</body>
</html>