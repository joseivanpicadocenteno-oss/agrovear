<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalRequest extends FormRequest
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
            'birth_date.date' => 'La fecha de nacimiento no es válida.',
            'birth_date.before_or_equal' => 'La fecha de nacimiento no puede ser futura.',

            'breed.required' => 'Se requiere la raza del animal.',
            'species.required' => 'Se requiere la especie del animal.',

            'weight_kg.required' => 'Se requiere el peso del animal.',
            'weight_kg.numeric' => 'El peso debe ser un valor numérico.',
            'weight_kg.min' => 'El peso no puede ser negativo.',

            'last_weighing.date' => 'La fecha de la última pesada no es válida.',
            'last_weighing.before_or_equal' => 'La fecha de la última pesada no puede ser futura.',

            'target_weight.numeric' => 'El peso objetivo debe ser un valor numérico.',
            'target_weight.min' => 'El peso objetivo no puede ser negativo.',

            'sex.required' => 'Se requiere especificar el sexo del animal.',
            'sex.string' => 'El sexo debe ser escrito en caracteres',
            'sex.max' => 'El maximo de caracteres permitidos para el genero es de 10',

            'reproductive_status.required' => 'Se requiere el estado reproductivo del animal.',
            'reproductive_status.string' => 'El estado reproductivo de su animal debe ingresarse en caracteres',
            'reproductive_status.max' => 'El estado reproductivo no puede contener mas de 100 caracteres',

            'purchase_price.numeric' => 'El precio de compra debe ser un valor numérico.',
            'estimated_price.numeric' => 'El precio estimado debe ser un valor numérico.',

            'farm_id.required' => 'La finca es requerida.',
            'farm_id.exists' => 'La finca seleccionada no existe.',
        ];
    }
}