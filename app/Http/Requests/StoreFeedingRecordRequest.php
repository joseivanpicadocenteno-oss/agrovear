<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedingRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'feeding_date' => 'required|date',
            'amount_served' => 'required|numeric|min:0',
            'estimated_feed_cost' => 'nullable|numeric|min:0',
            'animal_id' => 'required|exists:animals,id',
            'gestation_record_id' => 'nullable|exists:gestation_records,id',
            'recipe_id' => 'required|exists:recipes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'feeding_date.required' => 'La fecha de alimentación es requerida.',
            'feeding_date.date' => 'El formato de la fecha no es válido.',

            'amount_served.required' => 'La cantidad de alimento es requerida.',
            'amount_served.numeric' => 'La cantidad de alimento debe ser numérica.',
            'amount_served.min' => 'La cantidad de alimento no puede ser negativa.',

            'estimated_feed_cost.numeric' => 'El costo estimado debe ser numérico.',
            'estimated_feed_cost.min' => 'El costo estimado no puede ser negativo.',

            'animal_id.required' => 'El animal es requerido.',
            'animal_id.exists' => 'El animal seleccionado no existe.',

            'gestation_record_id.exists' => 'El registro de gestación seleccionado no existe.',

            'recipe_id.required' => 'La receta alimenticia es requerida.',
            'recipe_id.exists' => 'La receta seleccionada no existe.',
        ];
    }
}