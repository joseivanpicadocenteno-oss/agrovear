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
            'quantity' => 'required|integer',
            'instruction' => 'required|strig|max:255',
            'recipe_id' => 'required|exists:recipes,id',
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

            'recipe_id.required' => 'La identificacion de la receta es requerida.',
            'recipe_id.exists' => 'La identificacion de la receta aun no es creada',

            'product_id.required' => 'La identificacion del producto es requerido',
            'product_id.exists' => 'La identificacion del producto aun no es creada.',
        ];
    }
}
