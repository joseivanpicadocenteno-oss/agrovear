<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
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
        'description' => 'sometimes|string|max:255',
        'objective' => 'sometimes|string|max:255',
        'frequent_use' => 'sometimes|string|max:255',
        'filter_species' => 'sometimes|string|max:255',
        'min_age_filter' => 'sometimes|integer',
        'max_age_filter' => 'sometimes|integer',
        'min_weight_filter' => 'sometimes|numeric',
        'recommended_duration_days' => 'sometimes|integer',
        'suitable_for_gestation' => 'sometimes|boolean',
        'suitable_for_location' => 'sometimes|boolean',
        'farm_id' => 'sometimes|exists:farms,id',
        ];
    }
}
