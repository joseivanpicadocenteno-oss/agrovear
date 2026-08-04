<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeedingRecordRequest extends FormRequest
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
            'feeding_date' => 'sometimes|date',
            'amount_served' => 'sometimes|numeric',
            'estimated_feed_cost' => 'sometimes|numeric',
            'animal_id' => 'sometimes|exists:animals,id',
            'gestation_record_id' => 'nullable|exists:gestation_records,id',
            'recipe_id' => 'sometimes|exists:recipes,id',
        ];
    }
}
