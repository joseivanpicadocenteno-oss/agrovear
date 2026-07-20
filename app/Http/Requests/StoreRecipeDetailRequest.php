<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric',
            'instruction' => 'required|string|max:255',
            'recipe_id' => 'required|exists:recipes,id',
            'product_id' => 'required|exists:products,id',
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => '',
            'quantity.numeric' => '',

            'instruction.required' => '',
            'instruction.string' => '',
            'instruction.max' => '',

            'recipe_id' => '',
            'product_id' => '',
        ];
    }
}
