<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentDetailRequest extends FormRequest
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
     * // @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity_used' => 'required|numeric',
            'frequency' => 'required|string|max:255',
            'instructions' => 'required|string|max:255',
            'treatment_id' => 'required|exists:treatments,id',
            'product_id' => 'required|exists:products,id',
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'La cantidad del tratamiento es requerida.',
            'quantity.integer' => 'La cantidad del tratamiento debe ser un valor entero',

            'instruction.required' => 'Las instrucciones del tratamiento son requeridas.',
            'instruction.string' => 'Las instrucciones solo pueden contener letras.',
            'instruction.max' => 'Las instrucciones no pueden tener mas de 255 caracteres.',

            'treatment_id.required' => 'La identificacion del tratamiento es requerida.',
            'treatment_id.exists' => 'La identificacion del tratamiento aun no es creada',

            'product_id.required' => 'La identificacion del producto es requerido',
            'product_id.exists' => 'La identificacion del producto aun no es creada.',
        ];
    }
}
