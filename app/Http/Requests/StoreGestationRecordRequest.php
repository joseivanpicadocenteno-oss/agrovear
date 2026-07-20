<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGestationRecordRequest extends FormRequest
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
            'service_date' => 'required|date',
            'estimated_birth_date' => 'required|date',
            'actual_birth_date' => 'nullable|date',
            'live_births' => 'required|integer',
            'stillbirths' => 'required|integer',
            'observations' => 'nullable|string|max:1000',
            'active' => 'boolean',
            'animal_id' => 'required|exists:animals,id',
        ];
    }

    public function messages()
    {
        return [
            'service_date.required' => 'La fecha del servicio es requerida',
            'service_date.date' => 'La fecha del servicio no es valida',

            'estimated_birth_date.required' => 'La fecha de nacimiento estimada es requerida',
            'estimated_birth_date.date' => 'La fecha de nacimiento estimada no es valida',

            'live_births.required' => 'Los animales nacidos con vida son requeridos',
            'live_births.integer' => 'Los animales nacidos con vida deben ser numeros enteros',

            'stillbirths.required' => 'Los mortinatos son requeridos',
            'stillbirths.integer' => 'Los mortinatos deben ser numeros enteros',

            'animal_id.required' => 'Debe seleccionar un animal',
            'animal_id.exists' => 'El animal seleccionado no existe',
        ];
    }
}
