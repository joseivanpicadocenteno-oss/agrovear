<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreatmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date',
            'diagnosis' => 'sometimes|string|max:500',
            'observations' => 'sometimes|nullable|string|max:255',
            'active' => 'sometimes|boolean',
            'animal_id' => 'sometimes|exists:animals,id',
        ];
    }
}
