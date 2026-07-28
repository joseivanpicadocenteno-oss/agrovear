<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalRequest extends FormRequest
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
}
