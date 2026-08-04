<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeDetailRequest extends FormRequest
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
            'quantity' => 'sometimes|decimal:0,2',
            'instruction' => 'sometimes|string|max:255',
            'recipe_id' => 'sometimes|exists:recipes,id',
            'product_id' => 'sometimes|exists:products,id',
        ];
    }
}
