<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrovear - @yield('title', 'Sistema de Gestión')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'luz-natural': '#F5F0E6',
                        'verde-natural': '#397C02',
                        'oro-maiz': '#F2A900',
                        'tierra-fertil': '#76502F',
                    },
                    fontFamily: {
                        heading: ['Montserrat', 'sans-serif'],
                        body: ['Open Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-luz-natural font-body text-stone-800 antialiased min-h-screen flex flex-col">

    <div class="flex flex-1 min-h-screen">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-verde-natural text-white flex flex-col justify-between shadow-lg">
            <div>
                <!-- Logo -->
                <div class="p-6 border-b border-white/10 flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center font-heading font-bold text-verde-natural text-xl shadow-sm">
                        A
                    </div>
                    <div>
                        <h1 class="font-heading font-bold text-lg leading-tight">AGROVEAR</h1>
                        <span class="text-xs text-white/70">Gestión Ganadera</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1 text-sm font-heading font-semibold">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'text-white/80' }}">
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('farms.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('farms.*') ? 'bg-white/20 text-white' : 'text-white/80' }}">
                        <span>Fincas</span>
                    </a>
                    <a href="{{ route('animals.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('animals.*') ? 'bg-white/20 text-white' : 'text-white/80' }}">
                        <span>Animales</span>
                    </a>
                    <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('products.*') ? 'bg-white/20 text-white' : 'text-white/80' }}">
                        <span>Inventario / Productos</span>
                    </a>
                    <a href="{{ route('recipes.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('recipes.*') ? 'bg-white/20 text-white' : 'text-white/80' }}">
                        <span>Dietas y Recetas</span>
                    </a>
                    <a href="{{ route('gestations.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('gestations.*') ? 'bg-white/20 text-white' : 'text-white/80' }}">
                        <span>Gestaciones</span>
                    </a>
                    <a href="{{ route('treatments.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('treatments.*') ? 'bg-white/20 text-white' : 'text-white/80' }}">
                        <span>Tratamientos</span>
                    </a>
                    <a href="{{ route('feedings.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('feedings.*') ? 'bg-white/20 text-white' : 'text-white/80' }}">
                        <span>Alimentación</span>
                    </a>
                </nav>
            </div>

            <!-- User Info & Logout -->
            <div class="p-4 border-t border-white/10 bg-black/10">
                <div class="mb-3 px-2">
                    <p class="text-xs text-white/70">Usuario conectado:</p>
                    <p class="text-sm font-bold truncate">{{ auth()->user()->name ?? 'Usuario' }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-tierra-fertil hover:bg-opacity-90 text-white text-xs font-heading font-bold py-2 rounded-lg transition shadow-sm">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="bg-white border-b border-stone-200 py-4 px-8 flex justify-between items-center shadow-sm">
                <h2 class="font-heading font-bold text-xl text-tierra-fertil">@yield('page_title', 'Panel Principal')</h2>
                <span class="text-xs bg-luz-natural px-3 py-1 rounded-full text-tierra-fertil font-semibold border border-stone-300">
                    Sistema Activo
                </span>
            </header>

            <!-- Main Dynamic Container -->
            <div class="p-8 flex-1">
                <!-- Notifications / Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-100 border border-green-300 text-green-800 text-sm font-semibold flex justify-between items-center shadow-sm">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-red-100 border border-red-300 text-red-800 text-sm font-semibold flex justify-between items-center shadow-sm">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>