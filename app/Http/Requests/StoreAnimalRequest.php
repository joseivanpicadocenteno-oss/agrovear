<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnimalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',

            'birth_date' => 'nullable|date|before_or_equal:today',

            'breed' => 'required|string|max:255',

            'species' => 'required|string|max:255',

            'weight_kg' => 'required|numeric|min:0',

            'last_weighing' => 'nullable|date|before_or_equal:today',

            'target_weight' => 'nullable|numeric|min:0',

            'sex' => 'required|string|max:10',

            'reproductive_status' => 'required|string|max:100',

            'purchase_price' => 'nullable|numeric|min:0',

            'estimated_price' => 'nullable|numeric|min:0',

            'active' => 'nullable|boolean',

            'farm_id' => 'required|exists:farms,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Se requiere un nombre para el animal.',
            'name.string' => 'El nombre debe contener texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',

            'birth_date.date' => 'La fecha de nacimiento no es válida.',
            'birth_date.before_or_equal' => 'La fecha de nacimiento no puede ser futura.',

            'breed.required' => 'Se requiere la raza del animal.',
            'breed.string' => 'La raza debe contener texto.',
            'breed.max' => 'La raza no puede tener más de 255 caracteres.',

            'species.required' => 'Se requiere la especie del animal.',
            'species.string' => 'La especie debe contener texto.',
            'species.max' => 'La especie no puede tener más de 255 caracteres.',

            'weight_kg.required' => 'Se requiere el peso del animal.',
            'weight_kg.numeric' => 'El peso debe ser un valor numérico.',
            'weight_kg.min' => 'El peso no puede ser negativo.',

            'last_weighing.date' => 'La fecha de la última pesada no es válida.',
            'last_weighing.before_or_equal' => 'La fecha de la última pesada no puede ser futura.',

            'target_weight.numeric' => 'El peso objetivo debe ser un valor numérico.',
            'target_weight.min' => 'El peso objetivo no puede ser negativo.',

            'sex.required' => 'Se requiere especificar el sexo del animal.',
            'sex.string' => 'El sexo debe contener texto.',

            'reproductive_status.required' => 'Se requiere el estado reproductivo del animal.',

            'purchase_price.numeric' => 'El precio de compra debe ser un valor numérico.',
            'purchase_price.min' => 'El precio de compra no puede ser negativo.',

            'estimated_price.numeric' => 'El precio estimado debe ser un valor numérico.',
            'estimated_price.min' => 'El precio estimado no puede ser negativo.',

            'farm_id.required' => 'La finca es requerida.',
            'farm_id.exists' => 'La finca seleccionada no existe.',
        ];
    }
}