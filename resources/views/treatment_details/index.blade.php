@extends('layouts.app')

@section('title', 'Ingredientes de Recetas')
@section('page_title', 'Ingredientes de recetas')

@section('content')

<div class="max-w-7xl mx-auto">

```
{{-- Encabezado --}}
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

    <div>
        <p class="text-sm text-stone-500 mb-1">
            Recetas / Ingredientes
        </p>

        <h2 class="font-heading font-bold text-2xl text-tierra-fertil">
            Ingredientes de recetas
        </h2>

        <p class="text-sm text-stone-500 mt-1">
            Consulta y administra los productos utilizados en las recetas.
        </p>
    </div>

    <div class="flex flex-wrap gap-2">

        <a
            href="{{ route('recipes.index') }}"
            class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl border border-stone-300 bg-white text-tierra-fertil text-sm font-semibold hover:bg-stone-50 transition"
        >
            ← Recetas
        </a>

        <a
            href="{{ route('recipe-details.create') }}"
            class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-verde-natural text-white text-sm font-bold hover:opacity-90 transition"
        >
            + Nuevo ingrediente
        </a>

    </div>
</div>


{{-- Tabla --}}
<div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

    @if($recipeDetails->count())

        <div class="hidden md:block overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-stone-50 border-b border-stone-200">

                    <tr>

                        <th class="text-left px-6 py-4 font-heading font-bold text-tierra-fertil">
                            Receta
                        </th>

                        <th class="text-left px-6 py-4 font-heading font-bold text-tierra-fertil">
                            Finca
                        </th>

                        <th class="text-left px-6 py-4 font-heading font-bold text-tierra-fertil">
                            Producto
                        </th>

                        <th class="text-center px-6 py-4 font-heading font-bold text-tierra-fertil">
                            Cantidad
                        </th>

                        <th class="text-left px-6 py-4 font-heading font-bold text-tierra-fertil">
                            Instrucción
                        </th>

                        <th class="text-right px-6 py-4 font-heading font-bold text-tierra-fertil">
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-stone-100">

                    @foreach($recipeDetails as $detail)

                        <tr class="hover:bg-stone-50 transition">

                            <td class="px-6 py-4">

                                <a
                                    href="{{ route('recipes.show', $detail->recipe) }}"
                                    class="font-bold text-verde-natural hover:underline"
                                >
                                    {{ $detail->recipe->name ?? 'Sin receta' }}
                                </a>

                            </td>


                            <td class="px-6 py-4 text-stone-600">
                                {{ $detail->recipe->farm->name ?? 'Sin finca' }}
                            </td>


                            <td class="px-6 py-4">

                                <p class="font-semibold text-stone-700">
                                    {{ $detail->product->name ?? 'Producto eliminado' }}
                                </p>

                                @if($detail->product?->unit_measurement)

                                    <p class="text-xs text-stone-400 mt-1">
                                        {{ $detail->product->unit_measurement }}
                                    </p>

                                @endif

                            </td>


                            <td class="px-6 py-4 text-center">

                                <span class="inline-flex px-3 py-1.5 rounded-lg bg-stone-100 text-stone-700 text-xs font-bold">
                                    {{ number_format((float) $detail->quantity, 2) }}
                                </span>

                            </td>


                            <td class="px-6 py-4 text-stone-600 max-w-xs">
                                {{ $detail->instruction }}
                            </td>


                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    <a
                                        href="{{ route('recipe-details.show', $detail) }}"
                                        class="px-3 py-2 rounded-lg border border-stone-300 text-stone-600 text-xs font-bold hover:bg-stone-50"
                                    >
                                        Ver
                                    </a>


                                    <a
                                        href="{{ route('recipe-details.edit', $detail) }}"
                                        class="px-3 py-2 rounded-lg bg-amber-50 text-amber-700 text-xs font-bold hover:bg-amber-100"
                                    >
                                        Editar
                                    </a>


                                    <form
                                        action="{{ route('recipe-details.destroy', $detail) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este ingrediente?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-3 py-2 rounded-lg bg-red-50 text-red-600 text-xs font-bold hover:bg-red-100"
                                        >
                                            Eliminar
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{-- Vista móvil --}}
        <div class="md:hidden divide-y divide-stone-100">

            @foreach($recipeDetails as $detail)

                <div class="p-5">

                    <div class="flex items-start justify-between gap-4">

                        <div>
                            <a
                                href="{{ route('recipes.show', $detail->recipe) }}"
                                class="font-heading font-bold text-base text-verde-natural hover:underline"
                            >
                                {{ $detail->recipe->name ?? 'Sin receta' }}
                            </a>

                            <p class="text-xs text-stone-500 mt-1">
                                {{ $detail->recipe->farm->name ?? 'Sin finca' }}
                            </p>
                        </div>

                        <span class="px-2.5 py-1 rounded-lg bg-stone-100 text-stone-600 text-xs font-bold">
                            {{ number_format((float) $detail->quantity, 2) }}
                        </span>

                    </div>


                    <div class="mt-4 space-y-2">

                        <div>
                            <p class="text-xs text-stone-400">
                                Producto
                            </p>

                            <p class="text-sm font-semibold text-stone-700">
                                {{ $detail->product->name ?? 'Producto eliminado' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs text-stone-400">
                                Instrucción
                            </p>

                            <p class="text-sm text-stone-600">
                                {{ $detail->instruction }}
                            </p>
                        </div>

                    </div>


                    <div class="flex flex-wrap gap-2 mt-5">

                        <a
                            href="{{ route('recipe-details.show', $detail) }}"
                            class="px-3 py-2 rounded-lg border border-stone-300 text-stone-600 text-xs font-bold"
                        >
                            Ver
                        </a>

                        <a
                            href="{{ route('recipe-details.edit', $detail) }}"
                            class="px-3 py-2 rounded-lg bg-amber-50 text-amber-700 text-xs font-bold"
                        >
                            Editar
                        </a>

                        <form
                            action="{{ route('recipe-details.destroy', $detail) }}"
                            method="POST"
                            onsubmit="return confirm('¿Seguro que deseas eliminar este ingrediente?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-3 py-2 rounded-lg bg-red-50 text-red-600 text-xs font-bold"
                            >
                                Eliminar
                            </button>
                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="p-12 text-center">

            <div class="w-16 h-16 mx-auto rounded-2xl bg-green-50 text-verde-natural flex items-center justify-center mb-4">

                <svg
                    class="w-8 h-8"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v12m6-6H6"
                    />
                </svg>

            </div>


            <h3 class="font-heading font-bold text-lg text-tierra-fertil">
                No hay ingredientes registrados
            </h3>


            <p class="text-sm text-stone-500 mt-2">
                Agrega el primer ingrediente a una receta.
            </p>


            <a
                href="{{ route('recipe-details.create') }}"
                class="inline-flex items-center gap-2 mt-5 px-5 py-3 rounded-xl bg-verde-natural text-white text-sm font-bold hover:opacity-90"
            >
                + Nuevo ingrediente
            </a>

        </div>

    @endif

</div>


@if($recipeDetails->hasPages())

    <div class="mt-6">
        {{ $recipeDetails->links() }}
    </div>

@endif
```

</div>

@endsection
