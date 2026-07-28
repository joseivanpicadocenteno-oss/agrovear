<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
            'birth_date' => 'nullable|date',
            'breed' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'weight_kg' => 'required|numeric',
            'last_weighing' => 'required|date',
            'target_weight' => 'required|numeric',
            'sex' => 'required|string|max:10',
            'reproductive_status' => 'required|string',
            'purchase_price' => 'required|numeric',
            'estimated_price' => 'required|numeric',
            'active' => 'boolean',
            'farm_id' => 'required|exists:farms,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Se requiere de un nombre para su animal',
            'name.string' => 'El nombre solo puede contener texto',
            'name.max' => 'Nombre de animal no puede tener más de 255 caracteres',

            'breed.required' => 'Se requiere la raza del animal',
            'breed.string' => 'La raza solo puede contener texto',
            'breed.max' => 'La raza no puede tener más de 255 caracteres',
            
            'species.required' => 'Se requiere la especie del animal',
            'species.string' => 'La especie solo puede contener texto',
            'species.max' => 'La especie no puede tener más de 255 caracteres',
            
            'weight_kg.required' => 'Se requiere el peso del animal',
            'weight_kg.numeric' => 'El peso debe ser un valor numérico',
            
            'target_weight.required' => 'Se requiere el peso objetivo del animal',
            'target_weight.numeric' => 'El peso objetivo debe ser un valor numérico',
            
            'sex.required' => 'Se requiere especificar el sexo del animal',
            'sex.string' => 'El sexo solo puede contener texto',
            'sex.max' => 'El sexo no puede tener más de 255 caracteres',
            
            'reproductive_status.required' => 'Se requiere el estado reproductivo del animal',
            'reproductive_status.string' => 'El estado reproductivo solo puede contener texto',
            
            'purchase_price.required' => 'Se requiere el precio de compra del animal',
            'purchase_price.numeric' => 'El precio de compra debe ser un valor numérico',
            
            'estimated_price.required' => 'Se requiere el precio estimado del animal',
            'estimated_price.numeric' => 'El precio estimado debe ser un valor numérico',

            'farm_id.required' => 'La identificacion de granja es requerida',
            'farm_id.exists' => 'La granja seleccionada aun no es creada'
        ];
    }
}
