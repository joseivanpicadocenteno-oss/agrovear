<aside class="w-64 bg-tierra-fertil text-white min-h-screen p-4 flex flex-col justify-between shadow-lg">
    <div>
        {{-- Logo / Nombre del Sistema --}}
        <div class="px-4 py-3 font-heading font-bold text-xl text-oro-maiz border-b border-stone-700 mb-6 flex items-center justify-between">
            <span>Agrovear</span>
            <span class="text-xs bg-verde-natural text-white px-2 py-0.5 rounded font-sans uppercase">Web</span>
        </div>

        {{-- Enlaces de Navegación --}}
        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition hover:bg-stone-800 {{ request()->routeIs('dashboard') ? 'bg-verde-natural text-white' : 'text-stone-300' }}">
                📊 Dashboard
            </a>

            <a href="{{ route('farms.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition hover:bg-stone-800 {{ request()->routeIs('farms.*') ? 'bg-verde-natural text-white' : 'text-stone-300' }}">
                🌾 Fincas
            </a>

            <a href="{{ route('animals.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition hover:bg-stone-800 {{ request()->routeIs('animals.*') ? 'bg-verde-natural text-white' : 'text-stone-300' }}">
                🐄 Animales
            </a>

            <a href="{{ route('products.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition hover:bg-stone-800 {{ request()->routeIs('products.*') ? 'bg-verde-natural text-white' : 'text-stone-300' }}">
                📦 Inventario
            </a>

            <a href="{{ route('recipes.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition hover:bg-stone-800 {{ request()->routeIs('recipes.*') ? 'bg-verde-natural text-white' : 'text-stone-300' }}">
                🥗 Recetas
            </a>

            <a href="{{ route('gestations.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition hover:bg-stone-800 {{ request()->routeIs('gestations.*') ? 'bg-verde-natural text-white' : 'text-stone-300' }}">
                🩺 Gestaciones
            </a>

            <a href="{{ route('treatments.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition hover:bg-stone-800 {{ request()->routeIs('treatments.*') ? 'bg-verde-natural text-white' : 'text-stone-300' }}">
                💉 Tratamientos
            </a>

            <a href="{{ route('feedings.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold transition hover:bg-stone-800 {{ request()->routeIs('feedings.*') ? 'bg-verde-natural text-white' : 'text-stone-300' }}">
                🌾 Alimentación
            </a>
        </nav>
    </div>

    {{-- Pie de barra / Cierre de Sesión --}}
    <div class="border-t border-stone-700 pt-4">
        <div class="px-4 pb-2 text-xs text-stone-400 truncate">
            {{ auth()->user()->name ?? 'Usuario' }}
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 rounded-lg text-sm font-semibold text-red-300 hover:bg-stone-800 hover:text-red-200 transition">
                🚪 Cerrar Sesión
            </button>
        </form>
    </div>
</aside>