<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'objective' => 'required|string|max:255',
            'frequent_use' => 'required|string|max:255',
            'filter_species' => 'required|string|max:255',
            'min_age_filter' => 'required|integer',
            'max_age_filter' => 'required|integer',
            'min_weight_filter' => 'required|numeric',
            'recommended_duration_days' => 'required|integer',
            'suitable_for_gestation' => 'boolean',
            'suitable_for_location' => 'boolean',
            'farm_id' => 'required|exists:farms,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Se requiere el nombre de la receta',
            'name.string' => 'El nombre de la receta solo puede contener letras.',
            'name.max' => 'El nombre de la receta no puede tener más de 255 caracteres.',

            'description.required' => 'Se requiere una descripcion de la receta.',
            'description.string' => 'La descripcion de la receta solo puede contener letras.',
            'description.max' => 'La descripcion de la receta no puede tener más de 255 caracteres.',

            'objective.required' => 'Se requiere el objetivo de la receta.',
            'objective.string' => 'El objetivo de la receta solo puede contener letras.',
            'objective.max' => 'El objetivo de la receta no puede tener más de 255 caracteres.',

            'frequent_use.required' => 'Se requiere la frecuencia de uso de la receta.',
            'frequent_use.string' => 'La frecuencia de uso solo puede contener letras.',
            'frequent_use.max' => 'La frecuencia de uso no puede tener más de 255 caracteres.',

            'filter_species.required' => 'Se requiere la especie animal de la receta.',
            'filter_species.string' => 'La especie de la receta solo puede contener letras.',
            'filter_species.max' => 'la especie de la receta no puede tener más de 255 caracteres.',

            'min_age_filter.required' => 'Se requiere la edad minima para consumo.',
            'min_age_filter.integer' => 'La edad minima de consumo debe ser un número entero.',

            'max_age_filter.required' => 'Se requiere la edad máxima para consumo.',
            'max_age_filter.integer' => 'La edad máxima de consumo debe ser un número entero.',

            'min_weight_filter.required' => 'Se requiere el minimo de filtrado.',
            'min_weight_filter.numeric' => 'El peso minimo debe ser un valor númerico.',

            'recommended_duration_days.required' => 'Se requiere la recomendacion de dias de consumo.',
            'recommended_duration_days.integer' => 'Los dias recomendados debe ser un número entero.',

            'farm_id.required' => 'La identificacion de granja es requerida',
            'farm_id.exists' => 'La granja seleccionada aun no es creada'
        ];
    }
}
