@extends('layouts.app')

@section('title', 'Editar Receta')
@section('page_title', 'Editar receta')

@section('content')

<div class="max-w-6xl mx-auto">

```
{{-- Encabezado --}}
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

    <div>
        <p class="text-sm text-stone-500 mb-1">
            Recetas / {{ $recipe->name }} / Editar
        </p>

        <h2 class="font-heading font-bold text-2xl text-tierra-fertil">
            Editar receta
        </h2>

        <p class="text-sm text-stone-500 mt-1">
            Modifica los datos y los ingredientes de la receta.
        </p>
    </div>


    <div class="flex flex-wrap gap-2">

        <a
            href="{{ route('recipes.show', $recipe) }}"
            class="px-4 py-2.5 rounded-xl border border-stone-300 bg-white text-tierra-fertil text-sm font-semibold hover:bg-stone-50"
        >
            Ver receta
        </a>

        <a
            href="{{ route('recipes.index') }}"
            class="px-4 py-2.5 rounded-xl border border-stone-300 bg-white text-tierra-fertil text-sm font-semibold hover:bg-stone-50"
        >
            ← Recetas
        </a>

    </div>

</div>


<form
    action="{{ route('recipes.update', $recipe) }}"
    method="POST"
    class="space-y-6"
>
    @csrf
    @method('PUT')


    {{-- Información general --}}
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="p-6 border-b border-stone-100">

            <h3 class="font-heading font-bold text-base text-tierra-fertil">
                Información general
            </h3>

            <p class="text-xs text-stone-500 mt-1">
                Actualiza los datos principales.
            </p>

        </div>


        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Finca --}}
            <div class="md:col-span-2">

                <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Finca <span class="text-red-500">*</span>
                </label>

                <select
                    name="farm_id"
                    required
                    class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

                    <option value="">
                        Selecciona una finca
                    </option>

                    @foreach($farms as $farm)
                        <option
                            value="{{ $farm->id }}"
                            {{ old('farm_id', $recipe->farm_id) == $farm->id ? 'selected' : '' }}
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

                <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Nombre de la receta <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $recipe->name) }}"
                    required
                    maxlength="255"
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

                <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Objetivo
                </label>

                <input
                    type="text"
                    name="objective"
                    value="{{ old('objective', $recipe->objective) }}"
                    maxlength="255"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

            </div>


            {{-- Uso --}}
            <div>

                <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Uso frecuente
                </label>

                <input
                    type="text"
                    name="frequent_use"
                    value="{{ old('frequent_use', $recipe->frequent_use) }}"
                    maxlength="255"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none"
                >

            </div>


            {{-- Descripción --}}
            <div class="md:col-span-2">

                <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Descripción
                </label>

                <textarea
                    name="description"
                    rows="4"
                    maxlength="1000"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm focus:border-verde-natural focus:ring-2 focus:ring-green-100 outline-none resize-y"
                >{{ old('description', $recipe->description) }}</textarea>

            </div>

        </div>

    </div>


    {{-- Filtros --}}
    <div class="bg-white border border-stone-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="p-6 border-b border-stone-100">

            <h3 class="font-heading font-bold text-base text-tierra-fertil">
                Filtros y recomendaciones
            </h3>

        </div>


        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

            <div>

                <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Especie
                </label>

                <select
                    name="filter_species"
                    class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm"
                >

                    <option value="">Todas</option>

                    @foreach(['Bovino', 'Porcino', 'Ovino', 'Caprino'] as $species)

                        <option
                            value="{{ $species }}"
                            {{ old('filter_species', $recipe->filter_species) === $species ? 'selected' : '' }}
                        >
                            {{ $species }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div>

                <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Edad mínima (meses)
                </label>

                <input
                    type="number"
                    name="min_age_filter"
                    value="{{ old('min_age_filter', $recipe->min_age_filter) }}"
                    min="0"
                    step="1"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm"
                >

            </div>


            <div>

                <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Edad máxima (meses)
                </label>

                <input
                    type="number"
                    name="max_age_filter"
                    value="{{ old('max_age_filter', $recipe->max_age_filter) }}"
                    min="0"
                    step="1"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm"
                >

            </div>


            <div>

                <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Peso mínimo (kg)
                </label>

                <input
                    type="number"
                    name="min_weight_filter"
                    value="{{ old('min_weight_filter', $recipe->min_weight_filter) }}"
                    min="0"
                    step="0.01"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm"
                >

            </div>


            <div>

                <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                    Duración recomendada (días)
                </label>

                <input
                    type="number"
                    name="recommended_duration_days"
                    value="{{ old('recommended_duration_days', $recipe->recommended_duration_days) }}"
                    min="0"
                    step="1"
                    class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm"
                >

            </div>

        </div>


        <div class="px-6 pb-6 grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>

                <input
                    type="hidden"
                    name="suitable_for_gestation"
                    value="0"
                >

                <label class="flex items-center gap-3 p-4 rounded-xl border border-stone-200 bg-stone-50 cursor-pointer">

                    <input
                        type="checkbox"
                        name="suitable_for_gestation"
                        value="1"
                        {{ old('suitable_for_gestation', $recipe->suitable_for_gestation) ? 'checked' : '' }}
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


            <div>

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
                        {{ old('suitable_for_location', $recipe->suitable_for_location) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-stone-300 text-verde-natural focus:ring-green-200"
                    >

                    <div>
                        <p class="text-sm font-semibold text-tierra-fertil">
                            Apta para la ubicación
                        </p>

                        <p class="text-xs text-stone-500 mt-1">
                            Adecuada para la ubicación de la finca.
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
                    Puedes modificar, eliminar o agregar ingredientes.
                </p>
            </div>

            <button
                type="button"
                onclick="addIngredient()"
                class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-verde-natural text-white text-sm font-bold hover:opacity-90"
            >
                + Agregar ingrediente
            </button>

        </div>


        <div
            id="ingredients-container"
            class="p-6 space-y-4"
        >

            @forelse($recipe->recipeDetails as $detail)

                <div class="ingredient-row rounded-xl border border-stone-200 bg-stone-50 p-4">

                    {{-- ID del detalle existente --}}
                    <input
                        type="hidden"
                        name="details[{{ $loop->index }}][id]"
                        value="{{ $detail->id }}"
                    >


                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-end">

                        {{-- Producto --}}
                        <div class="lg:col-span-5">

                            <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                                Producto <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="details[{{ $loop->index }}][product_id]"
                                required
                                class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm"
                            >

                                <option value="">
                                    Selecciona un producto
                                </option>

                                @foreach($products as $product)
                                    <option
                                        value="{{ $product->id }}"
                                        {{ old("details.$loop->index.product_id", $detail->product_id) == $product->id ? 'selected' : '' }}
                                    >
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
                                name="details[{{ $loop->index }}][quantity]"
                                value="{{ old("details.$loop->index.quantity", $detail->quantity) }}"
                                min="0"
                                step="0.01"
                                required
                                class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm"
                            >

                        </div>


                        {{-- Instrucción --}}
                        <div class="lg:col-span-4">

                            <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                                Instrucción <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="details[{{ $loop->index }}][instruction]"
                                value="{{ old("details.$loop->index.instruction", $detail->instruction) }}"
                                maxlength="255"
                                required
                                class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm"
                            >

                        </div>


                        {{-- Eliminar --}}
                        <div class="lg:col-span-1">

                            <button
                                type="button"
                                onclick="removeIngredient(this)"
                                class="w-full px-3 py-3 rounded-xl border border-red-200 text-red-600 bg-white hover:bg-red-50"
                                title="Eliminar ingrediente"
                            >
                                ✕
                            </button>

                        </div>

                    </div>

                </div>

            @empty

                <div
                    id="empty-ingredients"
                    class="rounded-xl border border-dashed border-stone-300 bg-stone-50 p-8 text-center"
                >
                    <p class="text-sm font-semibold text-stone-500">
                        No hay ingredientes registrados.
                    </p>
                </div>

            @endforelse

        </div>

    </div>


    {{-- Botones --}}
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-stone-200 pt-6">

        <a
            href="{{ route('recipes.show', $recipe) }}"
            class="w-full sm:w-auto text-center px-5 py-3 rounded-xl border border-stone-300 text-stone-600 font-semibold text-sm hover:bg-stone-50"
        >
            Cancelar
        </a>

        <button
            type="submit"
            class="w-full sm:w-auto px-6 py-3 rounded-xl bg-verde-natural text-white font-heading font-bold text-sm hover:opacity-90"
        >
            Guardar cambios
        </button>

    </div>

</form>
```

</div>

{{-- Plantilla para nuevos ingredientes --}} <template id="ingredient-template">

```
<div class="ingredient-row rounded-xl border border-stone-200 bg-stone-50 p-4">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-end">

        <div class="lg:col-span-5">

            <label class="block text-sm font-semibold text-tierra-fertil mb-1.5">
                Producto <span class="text-red-500">*</span>
            </label>

            <select
                name="details[__INDEX__][product_id]"
                required
                class="w-full rounded-xl border border-stone-300 bg-white px-4 py-3 text-sm"
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
                class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm"
            >

        </div>


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
                class="w-full rounded-xl border border-stone-300 px-4 py-3 text-sm"
            >

        </div>


        <div class="lg:col-span-1">

            <button
                type="button"
                onclick="removeIngredient(this)"
                class="w-full px-3 py-3 rounded-xl border border-red-200 text-red-600 bg-white hover:bg-red-50"
            >
                ✕
            </button>

        </div>

    </div>

</div>
```

</template>

<script>
    let ingredientIndex = {{ $recipe->recipeDetails->count() }};

    function addIngredient() {

        const container = document.getElementById('ingredients-container');
        const template = document.getElementById('ingredient-template');

        const html = template.innerHTML.replaceAll(
            '__INDEX__',
            ingredientIndex
        );

        container.insertAdjacentHTML('beforeend', html);

        ingredientIndex++;
    }


    function removeIngredient(button) {

        const row = button.closest('.ingredient-row');

        if (row) {
            row.remove();
        }
    }
</script>

@endsection
