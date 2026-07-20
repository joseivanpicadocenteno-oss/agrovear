<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFeedingRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'feeding_date' => 'required|date',
            'amount_served' => 'required|numeric',
            'estimated_feed_cost' => 'required|numeric',
            'animal_id' => 'required|exists:animals,id',
            'gestation_record_id' => 'nullable|exists:gestation_records,id',
            'recipe_id' => 'required|exists:recipes,id',
        ];
    }

    public function messages()
    {
        return [
            'feeding_date.required' => 'La fecha de alimentacion es requerida.',
            'feeding_date.date' => 'El formato de la fecha debe ser valido.',

            'amount_served.required' => 'La cantidad de alimento a utilizar es requerida.',
            'amount_served.numeric' => 'La cantidad de alimento debe ser un numero entero',

            'estimated_feed_cost.required' => 'El costo estimado de la alimentacion es requerido',
            'estimated_feed_cost.numeric' => 'El costo estimado debe ser un numero entero.',

            'animal_id.required' => 'La identificacion del animal es requerida.',
            'animal_id.exists' => 'La granja seleccionada aun no es creada.',

            'recipe_id.required' => 'La receta alimenticia es requerida',
            'recipe_id.exists' => 'La receta alimenticia seleccionada no exise.',
        ];
    }
}
