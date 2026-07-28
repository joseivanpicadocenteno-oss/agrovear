<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeDetailRequest extends FormRequest
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
            'quantity' => 'required|decimal:0,2',
            'instruction' => 'required|string|max:255',
            'recipe_id' => 'required|exists:recipes,id',
            'product_id' => 'required|exists:products,id',
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'La cantidad de los detalles es requerida',
            'quantity.decimal' => 'La cantidad de detalles debe ser valores numericos',

            'instruction.required' => 'La instruccion detallada de receta es requerida',
            'instruction.string' => 'La instruccion detallada debe ser en letras',
            'instruction.max' => 'La instruccion detallada no puede tener mas de 255 caracteres.',

            'recipe_id.required' => 'La identificacion de receta es requerida',
            'recipe_id.exists' => 'La identificacion de receta aun no es creada.',

            'product_id.required' => 'La identificacion del producto es requerida.',
            'product_id.exists' => 'La identificacion del producto aun no es creada.'
        ];
    }
}
