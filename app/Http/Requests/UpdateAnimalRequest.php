<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalRequest extends FormRequest
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

            'weight_kg' => 'required|numeric|min:0',

            'last_weighing' => 'nullable|date',

            'target_weight' => 'nullable|numeric|min:0',

            'sex' => 'required|string|max:10',

            'reproductive_status' => 'required|string|max:100',

            'purchase_price' => 'nullable|numeric|min:0',

            'estimated_price' => 'nullable|numeric|min:0',

            'active' => 'nullable|boolean',

            'farm_id' => 'required|exists:farms,id',
        ];
    }
}
