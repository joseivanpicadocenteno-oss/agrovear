<aside
    class="w-64 min-h-screen bg-[#603813] text-white
           hidden lg:flex flex-col shadow-xl">

    <div class="p-6 border-b border-white/10">

        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-xl bg-[#397C0E]
                        flex items-center justify-center">

                <span class="text-[#F2A900] font-heading
                             font-black text-2xl">
                    A
                </span>

            </div>

            <div>
                <h1 class="font-heading text-xl font-bold">
                    Agrovear
                </h1>

                <p class="text-xs text-stone-300">
                    Gestión ganadera
                </p>
            </div>

        </div>

    </div>


    <nav class="flex-1 px-4 py-6 space-y-6">

        <div>

            <p class="px-3 mb-2 text-[10px] uppercase
                      tracking-widest text-stone-400 font-bold">
                Principal
            </p>

            <a href="{{ route('dashboard') }}"
               class="sidebar-link
               {{ request()->routeIs('dashboard')
                    ? 'sidebar-active'
                    : '' }}">

                <span>Dashboard</span>

            </a>

        </div>


        <div>

            <p class="px-3 mb-2 text-[10px] uppercase
                      tracking-widest text-stone-400 font-bold">
                Gestión
            </p>

            <div class="space-y-1">

                <a href="{{ route('farms.index') }}"
                   class="sidebar-link
                   {{ request()->routeIs('farms.*')
                        ? 'sidebar-active'
                        : '' }}">
                    Fincas
                </a>

                <a href="{{ route('animals.index') }}"
                   class="sidebar-link
                   {{ request()->routeIs('animals.*')
                        ? 'sidebar-active'
                        : '' }}">
                    Animales
                </a>

                <a href="{{ route('products.index') }}"
                   class="sidebar-link
                   {{ request()->routeIs('products.*')
                        ? 'sidebar-active'
                        : '' }}">
                    Inventario
                </a>

            </div>

        </div>


        <div>

            <p class="px-3 mb-2 text-[10px] uppercase
                      tracking-widest text-stone-400 font-bold">
                Nutrición
            </p>

            <div class="space-y-1">

                <a href="{{ route('recipes.index') }}"
                   class="sidebar-link
                   {{ request()->routeIs('recipes.*')
                        ? 'sidebar-active'
                        : '' }}">
                    Recetas
                </a>

                <a href="{{ route('feedings.index') }}"
                   class="sidebar-link
                   {{ request()->routeIs('feedings.*')
                        ? 'sidebar-active'
                        : '' }}">
                    Alimentación
                </a>

            </div>

        </div>


        <div>

            <p class="px-3 mb-2 text-[10px] uppercase
                      tracking-widest text-stone-400 font-bold">
                Salud
            </p>

            <div class="space-y-1">

                <a href="{{ route('gestations.index') }}"
                   class="sidebar-link
                   {{ request()->routeIs('gestations.*')
                        ? 'sidebar-active'
                        : '' }}">
                    Gestaciones
                </a>

                <a href="{{ route('treatments.index') }}"
                   class="sidebar-link
                   {{ request()->routeIs('treatments.*')
                        ? 'sidebar-active'
                        : '' }}">
                    Tratamientos
                </a>

            </div>

        </div>

    </nav>


    <div class="p-4 border-t border-white/10">

        <div class="mb-3 px-2">
            <p class="text-sm font-bold truncate">
                {{ auth()->user()->name ?? 'Usuario' }}
            </p>

            <p class="text-xs text-stone-400 truncate">
                {{ auth()->user()->email ?? '' }}
            </p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button
                type="submit"
                class="w-full text-left px-3 py-2 rounded-lg
                       text-sm font-semibold
                       text-stone-300 hover:bg-white/10
                       hover:text-white transition">

                Cerrar sesión

            </button>
        </form>

    </div>

</aside>