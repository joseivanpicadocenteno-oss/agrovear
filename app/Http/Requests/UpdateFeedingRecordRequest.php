<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeedingRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'feeding_date' => 'sometimes|date',
            'amount_served' => 'sometimes|numeric|min:0',
            'estimated_feed_cost' => 'nullable|numeric|min:0',
            'animal_id' => 'sometimes|exists:animals,id',
            'gestation_record_id' => 'nullable|exists:gestation_records,id',
            'recipe_id' => 'sometimes|exists:recipes,id',
        ];
    }
}