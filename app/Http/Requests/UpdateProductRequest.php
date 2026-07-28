<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'type' => 'sometimes|string|max:255',
            'unit_measurement' => 'sometimes|integer',
            'current_stock' => 'sometimes|integer',
            'min_stock' => 'sometimes|numeric',
            'unit_cost' => 'sometimes|numeric',
            'historical_average_price' => 'sometimes|numeric',
            'last_purchase_date' => 'sometimes|date',
            'regular_supplier' => 'sometimes|string|max:255',
            'batch' => 'sometimes|string|max:255',
            'expiration_date' => 'sometimes|date',
            'farm_id' => 'sometimes|exists:farms,id',
        ];
    }
}
