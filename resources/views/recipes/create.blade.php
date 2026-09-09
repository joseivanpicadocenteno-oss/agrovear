@extends('layouts.app')

@section('title', 'Nueva Receta')
@section('page_title', 'Registrar nueva receta')

@section('content')

<div class="max-w-6xl mx-auto">

```
{{-- Encabezado --}}
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <p class="text-sm text-stone-500 mb-1">
            Recetas / Nueva receta
        </p>

        <h2 class="font-heading font-bold text-2xl text-tierra-fertil">
            Crear receta alimenticia
        </h2>

        <p class="text-sm text-stone-500 mt-1">
            Registra la información de la receta y sus ingredientes.
        </p>
    </div>

    <a
        href="{{ route('recipes.index') }}"
        class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl border border-stone-300 bg-white text-tierra-fertil text-sm font-semibold hover:bg-stone-50 transition"
    >
        ← Volver a recetas
    </a>
</div>


<form
    action="{{ route('recipes.store') }}"
    method="POST"
    class="space-y-6"
    id="recipe-form"
>
    @csrf

    {{-- Información general --}}
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="p-6 border-b border-stone-100">
            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-green-100 text-verde-natural flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v12m6-6H6"/>
                    </svg>
                </div>

                <div>
                    <h3 class="font-heading font-bold text-base text-tierra-fertil">
                        Información general
                    </h3>

                    <p class="text-xs text-stone-500 mt-1">
                        Datos principales de la receta.
                    </p>
                </div>

            </div>
        </div>


        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Finca --}}
            <div class="md:col-span-2">

                <label
                    for="farm_id"
                    class="block text-sm font-semibold text-tierra-fertil mb-1.5"
                >
                    Finca <span class="text-red-500">*</span>
                </label>

                <select
                    id="farm_id"
                    name="farm_id"
                    required
                    class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >
                    <option value="">Selecciona una finca</option>

                    @foreach($farms as $farm)
                        <option
                            value="{{ $farm->id }}"
                            {{ old('farm_id') == $farm->id ? 'selected' : '' }}
                        >
                            {{ $farm->name }}
                        </option>
                    @endforeach
                </select>

                @error('farm_id')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Nombre --}}
            <div>

                <label
                    for="name"
                    class="block text-sm font-semibold text-tierra-fertil mb-1.5"
                >
                    Nombre de la receta <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    maxlength="255"
                    placeholder="Ej: Dieta de crecimiento"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

                @error('name')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Objetivo --}}
            <div>

                <label
                    for="objective"
                    class="block text-sm font-semibold text-tierra-fertil mb-1.5"
                >
                    Objetivo
                </label>

                <input
                    type="text"
                    id="objective"
                    name="objective"
                    value="{{ old('objective') }}"
                    maxlength="255"
                    placeholder="Ej: Crecimiento"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

                @error('objective')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Uso frecuente --}}
            <div>

                <label
                    for="frequent_use"
                    class="block text-sm font-semibold text-tierra-fertil mb-1.5"
                >
                    Uso frecuente
                </label>

                <input
                    type="text"
                    id="frequent_use"
                    name="frequent_use"
                    value="{{ old('frequent_use') }}"
                    maxlength="255"
                    placeholder="Ej: Alimentación diaria"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

                @error('frequent_use')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- Descripción --}}
            <div class="md:col-span-2">

                <label
                    for="description"
                    class="block text-sm font-semibold text-tierra-fertil mb-1.5"
                >
                    Descripción
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    maxlength="1000"
                    placeholder="Describe brevemente la receta..."
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none resize-y"
                >{{ old('description') }}</textarea>

                @error('description')
                    <span class="text-xs text-red-600 font-semibold">
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </div>
    </div>


    {{-- Filtros --}}
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="p-6 border-b border-stone-100">

            <h3 class="font-heading font-bold text-base text-tierra-fertil">
                Filtros y recomendaciones
            </h3>

            <p class="text-xs text-stone-500 mt-1">
                Define para qué animales está pensada esta receta.
            </p>

        </div>


        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

            {{-- Especie --}}
            <div>

                <label
                    for="filter_species"
                    class="block text-sm font-semibold text-tierra-fertil mb-1.5"
                >
                    Especie
                </label>

                <select
                    id="filter_species"
                    name="filter_species"
                    class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >
                    <option value="">Todas</option>

                    @foreach(['Bovino', 'Porcino', 'Ovino', 'Caprino'] as $species)
                        <option
                            value="{{ $species }}"
                            {{ old('filter_species') === $species ? 'selected' : '' }}
                        >
                            {{ $species }}
                        </option>
                    @endforeach

                </select>

            </div>


            {{-- Edad mínima --}}
            <div>

                <label
                    for="min_age_filter"
                    class="block text-sm font-semibold text-tierra-fertil mb-1.5"
                >
                    Edad mínima (meses)
                </label>

                <input
                    type="number"
                    id="min_age_filter"
                    name="min_age_filter"
                    value="{{ old('min_age_filter') }}"
                    min="0"
                    step="1"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

            </div>


            {{-- Edad máxima --}}
            <div>

                <label
                    for="max_age_filter"
                    class="block text-sm font-semibold text-tierra-fertil mb-1.5"
                >
                    Edad máxima (meses)
                </label>

                <input
                    type="number"
                    id="max_age_filter"
                    name="max_age_filter"
                    value="{{ old('max_age_filter') }}"
                    min="0"
                    step="1"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

            </div>


            {{-- Peso --}}
            <div>

                <label
                    for="min_weight_filter"
                    class="block text-sm font-semibold text-tierra-fertil mb-1.5"
                >
                    Peso mínimo (kg)
                </label>

                <input
                    type="number"
                    id="min_weight_filter"
                    name="min_weight_filter"
                    value="{{ old('min_weight_filter') }}"
                    min="0"
                    step="0.01"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

            </div>

        </div>


        <div class="px-6 pb-6 grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Duración --}}
            <div>

                <label
                    for="recommended_duration_days"
                    class="block text-sm font-semibold text-tierra-fertil mb-1.5"
                >
                    Duración recomendada (días)
                </label>

                <input
                    type="number"
                    id="recommended_duration_days"
                    name="recommended_duration_days"
                    value="{{ old('recommended_duration_days') }}"
                    min="0"
                    step="1"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

            </div>


            {{-- Gestación --}}
            <div class="flex items-end">

                <input
                    type="hidden"
                    name="suitable_for_gestation"
                    value="0"
                >

                <label class="w-full flex items-center gap-3 p-4 rounded-xl border border-stone-200 bg-stone-50 cursor-pointer">

                    <input
                        type="checkbox"
                        name="suitable_for_gestation"
                        value="1"
                        {{ old('suitable_for_gestation') ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-stone-300 text-verde-natural focus:ring-green-200"
                    >

                    <div>
                        <p class="text-sm font-semibold text-tierra-fertil">
                            Apta para gestación
                        </p>

                        <p class="text-xs text-stone-500 mt-1">
                            Puede utilizarse en animales gestantes.
                        </p>
                    </div>

                </label>

            </div>


            {{-- Ubicación --}}
            <div class="md:col-span-2">

                <input
                    type="hidden"
                    name="suitable_for_location"
                    value="0"
                >

                <label class="flex items-center gap-3 p-4 rounded-xl border border-stone-200 bg-stone-50 cursor-pointer">

                    <input
                        type="checkbox"
                        name="suitable_for_location"
                        value="1"
                        {{ old('suitable_for_location') ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-stone-300 text-verde-natural focus:ring-green-200"
                    >

                    <div>
                        <p class="text-sm font-semibold text-tierra-fertil">
                            Apta para la ubicación
                        </p>

                        <p class="text-xs text-stone-500 mt-1">
                            Marca la receta como adecuada para la ubicación de la finca.
                        </p>
                    </div>

                </label>

            </div>

        </div>
    </div>


    {{-- Ingredientes --}}
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="p-6 border-b border-stone-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h3 class="font-heading font-bold text-base text-tierra-fertil">
                    Ingredientes
                </h3>

                <p class="text-xs text-stone-500 mt-1">
                    Agrega los productos utilizados en la receta.
                </p>
            </div>

            <button
                type="button"
                onclick="addIngredient()"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-verde-natural text-white text-sm font-bold hover:opacity-90 transition"
            >
                + Agregar ingrediente
            </button>

        </div>


        <div class="p-6">

            <div
                id="ingredients-container"
                class="space-y-4"
            ></div>


            <div
                id="empty-ingredients"
                class="rounded-xl border border-dashed border-stone-300 bg-stone-50 p-8 text-center"
            >
                <p class="text-sm font-semibold text-stone-500">
                    No hay ingredientes agregados.
                </p>

                <p class="text-xs text-stone-400 mt-1">
                    Agrega al menos un ingrediente para completar la receta.
                </p>
            </div>

        </div>
    </div>


    {{-- Botones --}}
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-stone-200 pt-6">

        <a
            href="{{ route('recipes.index') }}"
            class="w-full sm:w-auto text-center px-5 py-3 rounded-xl border border-stone-300 bg-white text-stone-600 font-semibold text-sm hover:bg-stone-50 transition"
        >
            Cancelar
        </a>

        <button
            type="submit"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-verde-natural text-white font-heading font-bold text-sm shadow-sm hover:opacity-90 transition"
        >
            Guardar receta
        </button>

    </div>

</form>
```

</div>

{{-- Plantilla de ingrediente --}} <template id="ingredient-template">

```
<div class="ingredient-row rounded-xl border border-stone-200 bg-stone-50 p-4">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-end">

        {{-- Producto --}}
        <div class="lg:col-span-5">

            <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                Producto <span class="text-red-500">*</span>
            </label>

            <select
                name="details[__INDEX__][product_id]"
                required
                class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
            >

                <option value="">
                    Selecciona un producto
                </option>

                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }}
                        @if($product->unit_measurement)
                            — {{ $product->unit_measurement }}
                        @endif
                    </option>
                @endforeach

            </select>

        </div>


        {{-- Cantidad --}}
        <div class="lg:col-span-2">

            <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                Cantidad <span class="text-red-500">*</span>
            </label>

            <input
                type="number"
                name="details[__INDEX__][quantity]"
                min="0"
                step="0.01"
                required
                placeholder="0.00"
                class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
            >

        </div>


        {{-- Instrucción --}}
        <div class="lg:col-span-4">

            <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                Instrucción <span class="text-red-500">*</span>
            </label>

            <input
                type="text"
                name="details[__INDEX__][instruction]"
                maxlength="255"
                required
                placeholder="Ej: Mezclar uniformemente"
                class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
            >

        </div>


        {{-- Eliminar --}}
        <div class="lg:col-span-1">

            <button
                type="button"
                onclick="removeIngredient(this)"
                class="w-full px-3 py-3 rounded-xl border border-red-200 text-red-600 bg-white hover:bg-red-50 transition"
                title="Eliminar ingrediente"
            >
                ✕
            </button>

        </div>

    </div>

</div>
```

</template>

<script>
    let ingredientIndex = 0;

    function addIngredient() {

        const container = document.getElementById('ingredients-container');
        const empty = document.getElementById('empty-ingredients');
        const template = document.getElementById('ingredient-template');

        const html = template.innerHTML.replaceAll(
            '__INDEX__',
            ingredientIndex
        );

        container.insertAdjacentHTML('beforeend', html);

        ingredientIndex++;

        empty.classList.add('hidden');
    }


    function removeIngredient(button) {

        const row = button.closest('.ingredient-row');

        if (row) {
            row.remove();
        }

        const container = document.getElementById('ingredients-container');
        const empty = document.getElementById('empty-ingredients');

        if (container.children.length === 0) {
            empty.classList.remove('hidden');
        }
    }
</script>

@endsection
